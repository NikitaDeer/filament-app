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
        // Удаляем старые записи
        PricingOption::truncate();

        $options = [
            // Грузчики
            [
                'type' => 'грузчики',
                'name' => 'Грузчики (стандарт)',
                'description' => 'Профессиональные грузчики для погрузки/разгрузки. Опыт работы более 3 лет.',
                'price_per_hour' => 500,
                'price_per_floor' => null,
                'max_quantity' => 6,
                'is_active' => true,
            ],

            // Пассажиры
            [
                'type' => 'пассажиры',
                'name' => 'Пассажиры в кабине',
                'description' => 'Дополнительное место для пассажира в кабине водителя. Зависит от типа транспорта.',
                'price_per_hour' => 200,
                'price_per_floor' => null,
                'max_quantity' => 3,
                'is_active' => true,
            ],

            // Этажи
            [
                'type' => 'этажи',
                'name' => 'Подъем на этаж',
                'description' => 'Подъем груза на этаж без грузового лифта. При наличии грузового лифта не тарифицируется.',
                'price_per_hour' => null,
                'price_per_floor' => 150,
                'max_quantity' => 25,
                'is_active' => true,
            ],
        ];

        foreach ($options as $optionData) {
            PricingOption::create($optionData);
        }
    }
}
