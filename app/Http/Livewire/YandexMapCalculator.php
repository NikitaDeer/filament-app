<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Rate;
use App\Models\NotificationChannel;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class YandexMapCalculator extends Component
{
  public $from = '';
  public $to = '';
  public $name = '';
  public $phone = '';
  public $email = '';
  public $distance;
  public $cost;
  public $rate;
  public $comment = '';
  public $orderSubmittedSuccessfully = false;
  public $showError = false;

  public function mount()
  {
    // Получаем активный тариф при инициализации
    $this->rate = Rate::where('is_active', true)->first();
    if (!$this->rate) {
      // Создаем тариф по умолчанию, если ни одного нет
      $this->rate = Rate::create([
        'name' => 'Базовый',
        'price_per_km' => 50,
        'is_active' => true,
      ]);
    }
  }

  public function calculate()
  {
    // Добавляем проверку, чтобы убедиться, что тариф загружен
    if (!$this->rate) {
        $this->rate = Rate::where('is_active', true)->first();
        if (!$this->rate) {
            // Если тарифа всё ещё нет, можно показать ошибку или использовать значение по умолчанию
            session()->flash('error', 'Активный тариф не найден. Расчет невозможен.');
            return;
        }
    }

    $this->validate([
      'from' => 'required|string|min:3|max:255',
      'to' => 'required|string|min:3|max:255',
    ], [
      'from.required' => 'Пожалуйста, укажите адрес отправления',
      'from.min' => 'Адрес отправления должен содержать не менее 3 символов',
      'from.max' => 'Адрес отправления не должен превышать 255 символов',
      'to.required' => 'Пожалуйста, укажите адрес назначения',
      'to.min' => 'Адрес назначения должен содержать не менее 3 символов',
      'to.max' => 'Адрес назначения не должен превышать 255 символов',
    ]);

    // Передаем цену за км в браузер
    $this->dispatchBrowserEvent('calculate-route', [
      'from' => $this->from,
      'to' => $this->to,
      'price_per_km' => $this->rate->price_per_km
    ]);
  }

  public function submitOrder()
  {
    $validatedData = $this->validate([
      'name' => 'required|string|min:2|max:255',
      'phone' => [
        'required',
        'string',
        'min:10',
        'max:20',
        // разрешаем любые символы форматирования, но валидируем конечные цифры как российский номер
        function ($attribute, $value, $fail) {
          $digits = preg_replace('/[^0-9]/', '', (string) $value);
          if (strlen($digits) === 11 && ($digits[0] === '7' || $digits[0] === '8')) {
            return;
          }
          $fail('Введите номер телефона в формате +7 (XXX) XXX-XX-XX');
        },
      ],
      'email' => 'required|email:rfc|max:255',
      'from' => 'required|string|min:3|max:255',
      'to' => 'required|string|min:3|max:255',
      'distance' => 'required|numeric|min:0.1',
      'cost' => 'required|numeric|min:1',
      'comment' => 'nullable|string|max:1000',
    ], [
      'name.required' => 'Пожалуйста, укажите ваше имя',
      'name.min' => 'Имя должно содержать не менее 2 символов',
      'name.max' => 'Имя не должно превышать 255 символов',
      'phone.required' => 'Пожалуйста, укажите ваш номер телефона',
      'phone.min' => 'Номер телефона должен содержать не менее 10 символов',
      'phone.max' => 'Номер телефона не должен превышать 20 символов',
      'phone.regex' => 'Введите номер телефона в формате +7 (XXX) XXX-XX-XX',
      'email.required' => 'Пожалуйста, укажите ваш email',
      'email.email' => 'Пожалуйста, укажите корректный email адрес',
      'email.max' => 'Email не должен превышать 255 символов',
      'from.required' => 'Пожалуйста, укажите адрес отправления',
      'from.min' => 'Адрес отправления должен содержать не менее 3 символов',
      'from.max' => 'Адрес отправления не должен превышать 255 символов',
      'to.required' => 'Пожалуйста, укажите адрес назначения',
      'to.min' => 'Адрес назначения должен содержать не менее 3 символов',
      'to.max' => 'Адрес назначения не должен превышать 255 символов',
      'distance.required' => 'Расстояние не рассчитано. Пожалуйста, выполните расчет маршрута',
      'distance.min' => 'Расстояние должно быть больше 0',
      'cost.required' => 'Стоимость не рассчитана. Пожалуйста, выполните расчет маршрута',
      'cost.min' => 'Стоимость должна быть больше 0',
      'comment.max' => 'Комментарий не должен превышать 1000 символов',
    ]);

    $orderData = [
      'name' => $validatedData['name'],
      'phone' => $validatedData['phone'],
      'email' => $validatedData['email'],
      'from_address' => $validatedData['from'],
      'to_address' => $validatedData['to'],
      'distance' => $validatedData['distance'],
      'cost' => $validatedData['cost'],
      'comment' => $validatedData['comment'],
      'rate_id' => $this->rate->id,
    ];

    $order = Order::create($orderData);

    try {
      // Ищем сначала канал по умолчанию, затем любой активный
      $emailChannel = NotificationChannel::where('type', 'email')
        ->where('is_default', true)
        ->where('is_active', true)
        ->first();

      if (!$emailChannel) {
        $emailChannel = NotificationChannel::where('type', 'email')
          ->where('is_active', true)
          ->first();
      }

      $emailTo = $emailChannel ? $emailChannel->value : config('mail.from.address');

      Notification::route('mail', $emailTo)->notify(new NewOrderNotification($order));

      Log::info('New order notification sent to: ' . $emailTo, ['order_id' => $order->id]);

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
    // Повторно инициализируем тариф
    $this->mount();
    // Отправляем событие в браузер для очистки карты
    $this->dispatchBrowserEvent('new-order-started');
  }

  public function render()
  {
    return view('livewire.yandex-map-calculator');
  }
}
