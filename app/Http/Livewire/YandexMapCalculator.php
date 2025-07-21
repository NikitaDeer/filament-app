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
      'phone' => 'required|string|min:10|max:20|regex:/^[0-9+\-\s()]*$/',
      'email' => 'required|email:rfc,dns|max:255',
      'from' => 'required|string|min:3|max:255',
      'to' => 'required|string|min:3|max:255',
      'distance' => 'required|numeric|min:0.1',
      'cost' => 'required|numeric|min:1',
    ], [
      'name.required' => 'Пожалуйста, укажите ваше имя',
      'name.min' => 'Имя должно содержать не менее 2 символов',
      'name.max' => 'Имя не должно превышать 255 символов',
      'phone.required' => 'Пожалуйста, укажите ваш номер телефона',
      'phone.min' => 'Номер телефона должен содержать не менее 10 символов',
      'phone.max' => 'Номер телефона не должен превышать 20 символов',
      'phone.regex' => 'Номер телефона может содержать только цифры, пробелы и символы +()-',
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
    ]);

    $orderData = [
      'name' => $validatedData['name'],
      'phone' => $validatedData['phone'],
      'email' => $validatedData['email'],
      'from_address' => $validatedData['from'],
      'to_address' => $validatedData['to'],
      'distance' => $validatedData['distance'],
      'cost' => $validatedData['cost'],
      'rate_id' => $this->rate->id,
    ];

    $order = Order::create($orderData);

    try {
      // Получаем активный email канал уведомлений
      $emailChannel = NotificationChannel::where('type', 'email')
        ->where('is_active', true)
        ->first();

      // Если нет настроенного канала, используем адрес по умолчанию
      $emailTo = $emailChannel ? $emailChannel->value : 'nikita@dergunov.info';

      Notification::route('mail', $emailTo)->notify(new NewOrderNotification($order));

      session()->flash('success', 'Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.');

      // Сбрасываем форму
      $this->reset('name', 'phone', 'email', 'from', 'to', 'distance', 'cost');

      $this->emit('orderSubmitted');

    } catch (\Exception $e) {
      session()->flash('error', 'Не удалось отправить заявку. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.');
      Log::error('Ошибка отправки заявки: ' . $e->getMessage());
    }
  }

  public function render()
  {
    return view('livewire.yandex-map-calculator');
  }
}
