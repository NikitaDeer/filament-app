<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\NotificationChannel;
use Illuminate\Support\Facades\Log;

class YandexMapCalculator extends Component
{
  public $from = '';
  public $to = '';
  public $distance;
  public $cost;
  public $price_per_km = 50;

  public $name, $phone, $email, $comment;
  public $orderSubmittedSuccessfully = false;
  public $showError = false;

  protected $listeners = ['calculateRoute' => 'calculateRoute'];

  public function setDistanceAndCost($distance)
  {
    $this->distance = $distance;
    $this->cost = round($distance * $this->price_per_km);
  }

  public function resetAddress($field)
  {
    if ($field === 'from') {
      $this->from = '';
    } elseif ($field === 'to') {
      $this->to = '';
    }
    $this->distance = null;
    $this->cost = null;

    $this->emit('resetAddress', $field);
  }

  public function calculateRoute()
  {
    $this->emit('calculateRoute', [
      'from' => $this->from,
      'to' => $this->to,
      'price_per_km' => $this->price_per_km,
    ]);
  }

  public function submitOrder()
  {
    $validatedData = $this->validate([
      'name' => 'required|string|min:2|max:255',
      'phone' => 'required|string|min:10|max:20',
      'email' => 'required|email',
      'comment' => 'nullable|string|max:1000',
    ]);

    $order = Order::create([
      'name' => $this->name,
      'phone' => $this->phone,
      'email' => $this->email,
      'comment' => $this->comment,
      'from_address' => $this->from,
      'to_address' => $this->to,
      'distance' => $this->distance,
      'cost' => $this->cost,
    ]);

    try {
      $emailChannel = NotificationChannel::where('type', 'email')->where('is_active', true)->first();
      $emailTo = $emailChannel ? $emailChannel->value : 'nikita@dergunov.info';
      Mail::to($emailTo)->send(new NewOrderMail($order));
      $this->orderSubmittedSuccessfully = true;
    } catch (\Exception $e) {
      Log::error('Ошибка отправки уведомления о заказе: ' . $e->getMessage());
      $this->showError = true;
    }
  }

  public function newOrder()
  {
    $this->orderSubmittedSuccessfully = false;
    $this->reset('name', 'phone', 'email', 'comment');
  }

  public function render()
  {
    return view('livewire.yandex-map-calculator');
  }
}
