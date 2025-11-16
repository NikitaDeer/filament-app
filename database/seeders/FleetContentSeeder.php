<?php

namespace Database\Seeders;

use App\Models\FleetContent;
use Illuminate\Database\Seeder;

class FleetContentSeeder extends Seeder
{
    public function run(): void
    {
        FleetContent::create([
            'hero_title' => 'Наш автопарк',
            'hero_subtitle' => 'Современный парк грузовых автомобилей для любых задач. От небольших газелей до крупнотоннажных фур. Все машины в отличном техническом состоянии и готовы к работе.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->command->info('Создана первая опубликованная версия контента страницы "Автопарк"');
    }
}
