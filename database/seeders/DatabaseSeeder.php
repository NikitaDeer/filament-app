<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Tariff;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создание ролей
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        // Создание администратора
        $admin = User::create([
            'name' => 'Администратор',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('Admin');

        // Создание тестового пользователя
        $user = User::create([
            'name' => 'Пользователь',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('User');

        // Создание тарифов
        $tariff1 = Tariff::create([
            'title' => 'Базовый',
            'description' => 'Базовый тариф для начинающих',
            'price' => 100,
            'is_published' => true,
        ]);

        $tariff2 = Tariff::create([
            'title' => 'Премиум',
            'description' => 'Премиум тариф для продвинутых пользователей',
            'price' => 200,
            'is_published' => true,
        ]);

        // Создание тестовых заказов
        Order::create([
            'user_id' => $user->id,
            'tariff_id' => $tariff1->id,
            'order_status' => 'active',
        ]);

        Order::create([
            'user_id' => $user->id,
            'tariff_id' => $tariff2->id,
            'order_status' => 'non-active',
        ]);
    }
}
