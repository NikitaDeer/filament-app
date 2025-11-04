<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Service;
use App\Models\PricingOption;
use App\Models\NotificationChannel;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class YandexMapCalculator extends Component
{
  // Основные данные
  public $vehicle_id;
  public $vehicle;
  public $route_points = []; // Массив точек маршрута

  // Данные для формы заказа
  public $name = '';
  public $phone = '';
  public $email = '';
  public $comment = '';

  // Детали текущей точки (для модального окна)
  public $current_point_details = [
    'building' => '',
    'entrance' => '',
    'floor' => '',
    'intercom_code' => ''
  ];

  // Услуги и опции
  public $selected_services = [];
  public $loaders_count = 0;
  public $passengers_count = 0;
  public $floors_count = 0;
  public $has_cargo_elevator = false;

  // Расчеты
  public $estimated_hours = 2; // По умолчанию 2 часа
  public $distance = 0;
  public $base_distance_cost = 0;
  public $base_time_cost = 0;
  public $services_cost = 0;
  public $options_cost = 0;
  public $total_cost = 0;

  // Статусы
  public $orderSubmittedSuccessfully = false;
  public $showError = false;

  public function mount()
  {
    // Получаем первый активный автомобиль по умолчанию
    $this->vehicle = Vehicle::active()->ordered()->first();
    if ($this->vehicle) {
      $this->vehicle_id = $this->vehicle->id;
    }
  }

  /**
   * Выбрать автомобиль
   */
  public function selectVehicle($vehicleId)
  {
    $this->vehicle_id = $vehicleId;
    $this->vehicle = Vehicle::find($vehicleId);

    // Пересчитываем стоимость при смене автомобиля
    if (!empty($this->route_points) && count($this->route_points) >= 2) {
      $this->recalculate();
    }
  }

  /**
   * Добавить точку маршрута
   */
  public function addRoutePoint($address, $coords, $details = [])
  {
    $this->route_points[] = [
      'address' => $address,
      'coords' => $coords,
      'details' => $details,
      'is_intermediate' => count($this->route_points) > 0 && count($this->route_points) < 1, // Промежуточная, если не первая и не последняя
    ];

    // Если добавили вторую точку - пересчитываем
    if (count($this->route_points) >= 2) {
      $this->recalculate();
    }
  }

  /**
   * Удалить точку маршрута
   */
  public function removeRoutePoint($index)
  {
    if (isset($this->route_points[$index])) {
      unset($this->route_points[$index]);
      $this->route_points = array_values($this->route_points); // Переиндексация

      if (count($this->route_points) >= 2) {
        $this->recalculate();
      } else {
        $this->resetCalculation();
      }
    }
  }

  /**
   * Переключить услугу
   */
  public function toggleService($serviceId)
  {
    $key = array_search($serviceId, $this->selected_services);
    if ($key !== false) {
      unset($this->selected_services[$key]);
      $this->selected_services = array_values($this->selected_services);
    } else {
      $this->selected_services[] = $serviceId;
    }

    $this->recalculate();
  }

  /**
   * Обновить количество грузчиков
   */
  public function updateLoadersCount($count)
  {
    $loaderOption = PricingOption::ofType('loader')->active()->first();
    if ($loaderOption) {
      $this->loaders_count = max(0, min($count, $loaderOption->max_quantity));
    } else {
      $this->loaders_count = 0;
    }
    $this->recalculate();
  }

  /**
   * Обновить количество пассажиров
   */
  public function updatePassengersCount($count)
  {
    if (!$this->vehicle || !$this->vehicle->allows_passengers) {
      $this->passengers_count = 0;
      return;
    }

    $passengerOption = PricingOption::ofType('passenger')->active()->first();
    if ($passengerOption) {
      $maxPassengers = min($this->vehicle->max_passengers, $passengerOption->max_quantity);
      $this->passengers_count = max(0, min($count, $maxPassengers));
    } else {
      $this->passengers_count = 0;
    }
    $this->recalculate();
  }

  /**
   * Обновить количество этажей
   */
  public function updateFloorsCount($count)
  {
    $floorOption = PricingOption::ofType('floor')->active()->first();
    if ($floorOption) {
      $this->floors_count = max(0, min($count, $floorOption->max_quantity));
    } else {
      $this->floors_count = 0;
    }
    $this->recalculate();
  }

  /**
   * Переключить грузовой лифт
   */
  public function toggleCargoElevator()
  {
    $this->has_cargo_elevator = !$this->has_cargo_elevator;
    // Если есть грузовой лифт - этажи не учитываем
    $this->recalculate();
  }

  /**
   * Полный пересчет стоимости
   */
  public function recalculate()
  {
    if (!$this->vehicle || count($this->route_points) < 2) {
      return;
    }

    // Базовая стоимость за расстояние
    $this->calculateDistanceCost();

    // Базовая стоимость за время
    $this->calculateTimeCost();

    // Стоимость услуг
    $this->calculateServicesCost();

    // Стоимость дополнительных опций
    $this->calculateOptionsCost();

    // Общая стоимость
    $this->total_cost = $this->base_distance_cost + $this->base_time_cost + $this->services_cost + $this->options_cost;
  }

  /**
   * Рассчитать стоимость за расстояние
   */
  protected function calculateDistanceCost()
  {
    $this->base_distance_cost = $this->distance * $this->vehicle->price_per_km;
  }

  /**
   * Рассчитать стоимость за время
   */
  protected function calculateTimeCost()
  {
    $this->base_time_cost = $this->estimated_hours * $this->vehicle->price_per_hour;
  }

  /**
   * Рассчитать стоимость услуг
   */
  protected function calculateServicesCost()
  {
    if (empty($this->selected_services)) {
      $this->services_cost = 0;
      return;
    }

    $services = Service::whereIn('id', $this->selected_services)->get();
    $this->services_cost = $services->sum('price');
  }

  /**
   * Рассчитать стоимость дополнительных опций
   */
  protected function calculateOptionsCost()
  {
    $cost = 0;

    // Грузчики
    if ($this->loaders_count > 0) {
      $loaderOption = PricingOption::ofType('loader')->active()->first();
      if ($loaderOption) {
        $cost += $this->loaders_count * $loaderOption->price_per_hour * $this->estimated_hours;
      }
    }

    // Пассажиры
    if ($this->passengers_count > 0) {
      $passengerOption = PricingOption::ofType('passenger')->active()->first();
      if ($passengerOption) {
        $cost += $this->passengers_count * $passengerOption->price_per_hour * $this->estimated_hours;
      }
    }

    // Этажи (только если нет грузового лифта)
    if ($this->floors_count > 0 && !$this->has_cargo_elevator) {
      $floorOption = PricingOption::ofType('floor')->active()->first();
      if ($floorOption) {
        $cost += $this->floors_count * $floorOption->price_per_floor;
      }
    }

    $this->options_cost = $cost;
  }

  /**
   * Сброс расчета
   */
  protected function resetCalculation()
  {
    $this->distance = 0;
    $this->base_distance_cost = 0;
    $this->base_time_cost = 0;
    $this->services_cost = 0;
    $this->options_cost = 0;
    $this->total_cost = 0;
  }

  /**
   * Отправить заказ
   */
  public function submitOrder()
  {
    $validatedData = $this->validate([
      'name' => 'required|string|min:2|max:255',
      'phone' => [
        'required',
        'string',
        'min:10',
        'max:20',
        function ($attribute, $value, $fail) {
          $digits = preg_replace('/[^0-9]/', '', (string) $value);
          if (strlen($digits) === 11 && ($digits[0] === '7' || $digits[0] === '8')) {
            return;
          }
          $fail('Введите номер телефона в формате +7 (XXX) XXX-XX-XX');
        },
      ],
      'email' => 'required|email:rfc|max:255',
      'vehicle_id' => 'required|exists:vehicles,id',
      'route_points' => 'required|array|min:2',
      'distance' => 'required|numeric|min:0.1',
      'total_cost' => 'required|numeric|min:1',
      'comment' => 'nullable|string|max:1000',
    ]);

    $orderData = [
      'name' => $validatedData['name'],
      'phone' => $validatedData['phone'],
      'email' => $validatedData['email'],
      'vehicle_id' => $validatedData['vehicle_id'],
      'route_points' => $this->route_points,
      'selected_services' => $this->selected_services,
      'loaders_count' => $this->loaders_count,
      'passengers_count' => $this->passengers_count,
      'floors_count' => $this->floors_count,
      'has_cargo_elevator' => $this->has_cargo_elevator,
      'estimated_hours' => $this->estimated_hours,
      'distance' => $this->distance,
      'base_distance_cost' => $this->base_distance_cost,
      'base_time_cost' => $this->base_time_cost,
      'services_cost' => $this->services_cost,
      'options_cost' => $this->options_cost,
      'total_cost' => $this->total_cost,
      'comment' => $validatedData['comment'],
      // Для совместимости со старой структурой
      'from_address' => $this->route_points[0]['address'] ?? '',
      'to_address' => end($this->route_points)['address'] ?? '',
      'old_cost' => $this->total_cost,
    ];

    $order = Order::create($orderData);

    try {
      $emailChannel = NotificationChannel::where('type', 'email')
        ->where('is_active', true)
        ->first();

      $emailTo = $emailChannel ? $emailChannel->value : config('mail.from.address');

      Notification::route('mail', $emailTo)->notify(new NewOrderNotification($order));

      Log::info('New order notification sent', ['order_id' => $order->id]);

      $this->orderSubmittedSuccessfully = true;
      $this->reset('name', 'phone', 'email', 'comment');
      $this->showError = false;

    } catch (\Exception $e) {
      Log::error('Ошибка отправки заявки: ' . $e->getMessage(), ['order_id' => $order->id]);
      $this->showError = true;
    }
  }

  public function resetForm()
  {
    $this->showError = false;
  }

  public function newOrder()
  {
    $this->reset();
    $this->orderSubmittedSuccessfully = false;
    $this->mount();
    $this->dispatchBrowserEvent('new-order-started');
  }

  public function render()
  {
    $vehicles = Vehicle::active()->ordered()->get();
    $services = Service::where('is_published', true)
                       ->where('is_calculator_option', true)
                       ->get();

    $loaderOption = PricingOption::ofType('loader')->active()->first();
    $passengerOption = PricingOption::ofType('passenger')->active()->first();
    $floorOption = PricingOption::ofType('floor')->active()->first();

    return view('livewire.yandex-map-calculator', [
      'vehicles' => $vehicles,
      'services' => $services,
      'loaderOption' => $loaderOption,
      'passengerOption' => $passengerOption,
      'floorOption' => $floorOption,
    ]);
  }
}
