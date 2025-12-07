<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderNotification;
use App\Models\Order;
use NotificationChannels\Telegram\TelegramChannel;

class TestTelegramNotification extends Command
{
    protected $signature = 'test:telegram {chat_id}';
    protected $description = 'Test Telegram notification';

    public function handle()
    {
        $chatId = $this->argument('chat_id');
        $order = Order::latest()->first();

        if (!$order) {
            $this->error('No orders found.');
            return;
        }

        $this->info("Sending notification for Order #{$order->id} to Chat ID: {$chatId}");

        try {
            Notification::route('telegram', $chatId)
                ->notify(new NewOrderNotification($order));
            
            $this->info('Notification sent (check logs for details).');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
