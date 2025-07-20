<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Rate;
use App\Models\NotificationChannel;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;
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
            'from' => 'required|string',
            'to' => 'required|string',
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'from' => 'required|string',
            'to' => 'required|string',
            'distance' => 'required|numeric',
            'cost' => 'required|numeric',
        ]);

        $orderData = [
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'from_address' => $validatedData['from'],
            'to_address' => $validatedData['to'],
            'distance' => $validatedData['distance'],
            'cost' => $validatedData['cost'],
        ];

        $order = Order::create($orderData);

        try {
            // Получаем все активные email каналы уведомлений
            $emailChannels = NotificationChannel::getEmailChannels();
            
            // Если нет настроенных каналов, используем адрес по умолчанию для тестирования
            if ($emailChannels->isEmpty()) {
                Mail::to('nikita@dergunov.info')->send(new NewOrderMail($order));
            } else {
                // Отправляем уведомление на все настроенные email адреса
                foreach ($emailChannels as $channel) {
                    Mail::to($channel->value)->send(new NewOrderMail($order));
                }
            }
            
            session()->flash('message', 'Ваша заявка успешно отправлена!');
            $this->reset('name', 'phone', 'email', 'from', 'to', 'distance', 'cost');
            
            // Отправляем событие для обновления карты
            $this->emit('orderSubmitted');
        } catch (\Exception $e) {
            session()->flash('message', 'Не удалось отправить заявку. Пожалуйста, попробуйте позже.');
        }
    }

    public function render()
    {
        return view('livewire.yandex-map-calculator');
    }
}