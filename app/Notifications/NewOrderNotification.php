<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
// use Illuminate\Contracts\Queue\ShouldQueue; // Убираем, чтобы отправлять синхронно
use Illuminate\Notifications\Messages\MailMessage;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class NewOrderNotification extends Notification
{
  use Queueable;

  private $order;
  private $user;

  /**
   * Create a new notification instance.
   */
  public function __construct(Order $order)
  {
    $this->order = $order;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail', TelegramChannel::class];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->subject('Новая заявка на перевозку №' . $this->order->id)
      ->markdown('emails.new-order', ['order' => $this->order]);
  }

  public function toTelegram($notifiable)
  {
      $url = route('filament.resources.orders.edit', $this->order);

      return TelegramMessage::create()
          // ->to($notifiable->telegram_chat_id) // Removed to allow auto-routing via Notification::route
          ->content("📦 *Новая заявка на перевозку №{$this->order->id}*\n\n" .
              "👤 *Имя:* {$this->order->name}\n" .
              "📞 *Телефон:* {$this->order->phone}\n" .
              "💰 *Стоимость:* {$this->order->total_cost} руб.\n" .
              "📍 *Маршрут:* {$this->order->from_address} -> {$this->order->to_address}\n\n" .
              "[Открыть заказ]({$url})");
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
