<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Page;
use App\Models\Advantage;
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

        // Создание базового пустого тарифа
        $emptyTariff = Tariff::create([
            'title' => 'Нет тарифа',
            'description' => 'Базовый тариф для новых пользователей',
            'price' => 0,
            'is_published' => true,
        ]);

        // Создание обычного тарифа
        $tariff = Tariff::create([
            'title' => 'Базовый',
            'description' => 'Базовый тариф для начинающих',
            'price' => 100,
            'is_published' => true,
        ]);

        // Создание администратора
        $admin = User::create([
            'name' => 'Администратор',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'current_tariff_id' => $emptyTariff->id,
            'tariff_status' => 'non-active',
        ]);
        $admin->assignRole('Admin');

        // Создание тестового пользователя
        $user = User::create([
            'name' => 'Пользователь',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'current_tariff_id' => $tariff->id,
            'tariff_status' => 'active',
        ]);
        $user->assignRole('User');

        // Создание тестовых заказов
        Order::create([
            'user_id' => $user->id,
            'tariff_id' => $tariff->id,
            'duration' => '1_month',
            'final_price' => $tariff->calculatePrice('1_month'),
            'order_status' => 'active',
        ]);

        // Создание страниц и преимуществ
        Page::factory(3)->create();
        Advantage::factory(6)->create();
    }
}
