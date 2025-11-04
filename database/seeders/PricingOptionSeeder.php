<?php

namespace Database\Seeders;

use App\Models\PricingOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            // Грузчики
            [
                'type' => 'loader',
                'name' => 'Грузчик',
                'description' => 'Профессиональный грузчик для погрузки/разгрузки',
                'price_per_hour' => 500,
                'price_per_floor' => null,
                'max_quantity' => 3,
                'is_active' => true,
            ],

            // Пассажиры
            [
                'type' => 'passenger',
                'name' => 'Пассажир',
                'description' => 'Дополнительное место для пассажира в кабине',
                'price_per_hour' => 200,
                'price_per_floor' => null,
                'max_quantity' => 2,
                'is_active' => true,
            ],

            // Этажи
            [
                'type' => 'floor',
                'name' => 'Этаж',
                'description' => 'Подъем груза на этаж без лифта',
                'price_per_hour' => null,
                'price_per_floor' => 100,
                'max_quantity' => 20,
                'is_active' => true,
            ],
        ];

        foreach ($options as $optionData) {
            PricingOption::create($optionData);
        }
    }
}
