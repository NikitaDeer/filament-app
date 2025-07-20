<?php

namespace Database\Seeders;

use App\Models\NotificationChannel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем тестовый канал уведомлений по электронной почте
        NotificationChannel::create([
            'name' => 'Основной email',
            'type' => 'email',
            'value' => 'nikita@dergunov.info',
            'is_active' => true,
            'is_default' => true,
        ]);
        
        // Создаем дополнительный канал уведомлений (неактивный)
        NotificationChannel::create([
            'name' => 'Резервный email',
            'type' => 'email',
            'value' => 'admin@example.com',
            'is_active' => false,
            'is_default' => false,
        ]);
    }
}
