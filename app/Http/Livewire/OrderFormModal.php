<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\NotificationChannel;
use Illuminate\Support\Facades\Log;

class OrderFormModal extends Component
{
  public $showModal = false;
  public $from, $to, $distance, $cost;
  public $name, $phone, $email, $comment;
  public $orderSubmittedSuccessfully = false;

  protected $listeners = ['openOrderForm' => 'openModal'];

  public function openModal()
  {
    $this->showModal = true;
  }

  public function closeModal()
  {
    $this->showModal = false;
    $this->orderSubmittedSuccessfully = false;
    $this->reset('name', 'phone', 'email', 'comment');
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
      // Здесь можно добавить событие для отображения ошибки пользователю
    }
  }

  public function render()
  {
    return view('livewire.order-form-modal');
  }
}
