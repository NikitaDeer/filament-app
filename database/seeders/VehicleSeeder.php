<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'description' => 'Компактный грузовик для небольших перевозок по городу',
                'allows_passengers' => true,
                'max_passengers' => 2,
                'price_per_km' => 35,
                'price_per_hour' => 500,
                'capacity_tons' => 1.5,
                'length_m' => 3.0,
                'width_m' => 2.0,
                'height_m' => 1.8,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Газель 4м',
                'description' => 'Универсальный вариант для большинства грузов',
                'allows_passengers' => true,
                'max_passengers' => 2,
                'price_per_km' => 40,
                'price_per_hour' => 600,
                'capacity_tons' => 2.0,
                'length_m' => 4.0,
                'width_m' => 2.0,
                'height_m' => 2.0,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Газель 6м',
                'description' => 'Для крупногабаритных грузов и мебели',
                'allows_passengers' => true,
                'max_passengers' => 1,
                'price_per_km' => 50,
                'price_per_hour' => 700,
                'capacity_tons' => 3.0,
                'length_m' => 6.0,
                'width_m' => 2.2,
                'height_m' => 2.2,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Фура 20т',
                'description' => 'Большегрузный транспорт для крупных перевозок',
                'allows_passengers' => false,
                'max_passengers' => 0,
                'price_per_km' => 80,
                'price_per_hour' => 1500,
                'capacity_tons' => 20.0,
                'length_m' => 13.6,
                'width_m' => 2.45,
                'height_m' => 2.7,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            Vehicle::create($vehicleData);
        }
    }
}
