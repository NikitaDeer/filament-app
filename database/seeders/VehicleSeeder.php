<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Газель 3м',
                'description' => 'Компактная Газель для городских перевозок. Идеально подходит для квартирных переездов и небольших грузов.',
                'allows_passengers' => true,
                'max_passengers' => 2,
                'price_per_hour' => 800,
                'price_per_km' => 35,
                'capacity_tons' => 1.5,
                'length_m' => 3.0,
                'width_m' => 1.9,
                'height_m' => 1.8,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Газель 4м',
                'description' => 'Стандартная Газель с удлиненным кузовом. Оптимальный вариант для большинства задач.',
                'allows_passengers' => true,
                'max_passengers' => 2,
                'price_per_hour' => 900,
                'price_per_km' => 40,
                'capacity_tons' => 1.5,
                'length_m' => 4.0,
                'width_m' => 1.9,
                'height_m' => 2.0,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Газель 5м (фургон)',
                'description' => 'Вместительный фургон для крупных грузов. Защита от погодных условий.',
                'allows_passengers' => true,
                'max_passengers' => 1,
                'price_per_hour' => 1000,
                'price_per_km' => 45,
                'capacity_tons' => 1.5,
                'length_m' => 5.0,
                'width_m' => 2.0,
                'height_m' => 2.2,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Бычок 5т',
                'description' => 'Грузовик повышенной грузоподъемности для тяжелых грузов и строительных материалов.',
                'allows_passengers' => true,
                'max_passengers' => 2,
                'price_per_hour' => 1500,
                'price_per_km' => 60,
                'capacity_tons' => 5.0,
                'length_m' => 5.5,
                'width_m' => 2.2,
                'height_m' => 2.5,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Камаз 10т',
                'description' => 'Большегрузный автомобиль для масштабных перевозок и строительных работ.',
                'allows_passengers' => true,
                'max_passengers' => 1,
                'price_per_hour' => 2500,
                'price_per_km' => 80,
                'capacity_tons' => 10.0,
                'length_m' => 6.0,
                'width_m' => 2.4,
                'height_m' => 2.5,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Легковой автомобиль',
                'description' => 'Легковой автомобиль для транспортировки пассажиров и мелких грузов.',
                'allows_passengers' => true,
                'max_passengers' => 3,
                'price_per_hour' => 500,
                'price_per_km' => 25,
                'capacity_tons' => 0.3,
                'length_m' => 1.5,
                'width_m' => 1.2,
                'height_m' => 1.0,
                'is_active' => true,
                'sort_order' => 0,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}

