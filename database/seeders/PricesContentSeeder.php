<?php

namespace Database\Seeders;

use App\Models\PricesContent;
use Illuminate\Database\Seeder;

class PricesContentSeeder extends Seeder
{
    public function run(): void
    {
        PricesContent::create([
            'hero_badge' => 'Прозрачное ценообразование',
            'hero_title' => 'Актуальные цены на грузоперевозки',
            'hero_subtitle' => 'Все цены указаны с учетом НДС. Точную стоимость вашего заказа можно рассчитать в нашем онлайн-калькуляторе',
            'transport_section_title' => 'Аренда грузового транспорта',
            'transport_section_subtitle' => 'Стоимость аренды за километр и час работы',
            'options_section_title' => 'Дополнительные опции',
            'options_section_subtitle' => 'Услуги грузчиков, подъем на этаж и другие опции',
            'special_section_title' => 'Особые услуги',
            'special_section_subtitle' => 'Специализированные услуги для сложных задач',
            'conditions_section_title' => 'Условия работы',
            'conditions_section_description' => 'Минимальный заказ — 2 часа работы. Время подачи машины — 30-60 минут после подтверждения заказа. Оплата наличными или по безналичному расчету.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->command->info('Создана первая опубликованная версия контента страницы "Цены"');
    }
}
