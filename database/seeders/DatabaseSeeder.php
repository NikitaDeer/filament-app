<?php

namespace Database\Seeders;

use App\Models\{User, Order, Page, Advantage, Tariff, Subscription, AccessKey};
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
    // Создание ролей
    Role::create(['name' => 'Admin']);
    Role::create(['name' => 'User']);

    // Создание тарифов с новыми полями
    $trialTariff = Tariff::create([
        'title' => '7 Days Trial',
        'type' => 'trial',
        'duration_days' => 7,
        'price' => 0,
        'description' => 'Пробный период на 7 дней',
        'is_published' => true,
        'is_renewable' => false
    ]);

    $basicTariff = Tariff::create([
        'title' => 'Monthly Premium',
        'type' => 'regular',
        'duration_days' => 30,
        'price' => 100,
        'description' => 'Ежемесячная подписка',
        'is_published' => true,
        'is_renewable' => true
    ]);

    // Создание администратора
    $admin = User::create([
        'name' => 'Администратор',
        'email' => 'admin@admin.com',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
        'telegram_id' => null,
        'trial_used' => true,
        'trial_ends_at' => now()->addYear(),
        'current_tariff_id' => $trialTariff->id,
        'tariff_status' => 'active'
    ]);
    $admin->assignRole('Admin');

    // Создание тестового пользователя с активной подпиской
    $user = User::create([
        'name' => 'Пользователь',
        'email' => 'user@user.com',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
        'telegram_id' => 123456789,
        'trial_used' => false,
        'trial_ends_at' => null,
        'current_tariff_id' => $basicTariff->id,
        'tariff_status' => 'active'
    ]);
    $user->assignRole('User');

    // Создание активной подписки
    $subscription = Subscription::create([
        'user_id' => $user->id,
        'tariff_id' => $basicTariff->id,
        'start_date' => now(),
        'end_date' => now()->addDays(30),
        'status' => 'active',
        'final_price' => $basicTariff->price
    ]);

    // Генерация ключа доступа
    AccessKey::create([
        'user_id' => $user->id,
        'subscription_id' => $subscription->id,
        'encrypted_key' => Crypt::encryptString(Str::random(40)),
        'generated_at' => now(),
        'expires_at' => $subscription->end_date,
        'is_active' => true
    ]);

    // Создание демо-контента
    Page::factory(3)->create();
    Advantage::factory(6)->create();
    
    // Создание каналов уведомлений
    $this->call(NotificationChannelSeeder::class);

    // Создание 50 тестовых пользователей
    User::factory(50)->create()->each(function ($user) use ($basicTariff) {
        $user->assignRole('User');
        
        if (rand(0, 1)) {
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'tariff_id' => $basicTariff->id,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'status' => 'active',
                'final_price' => $basicTariff->price
            ]);

            AccessKey::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'encrypted_key' => Crypt::encryptString(Str::random(40)),
                'generated_at' => now(),
                'expires_at' => $subscription->end_date,
                'is_active' => true
            ]);
        }
    });
    }
}
