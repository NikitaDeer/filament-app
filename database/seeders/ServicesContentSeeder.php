<?php

namespace Database\Seeders;

use App\Models\ServicesContent;
use Illuminate\Database\Seeder;

class ServicesContentSeeder extends Seeder
{
    public function run(): void
    {
        ServicesContent::create([
            'hero_badge' => 'Наши услуги',
            'hero_title' => 'Полный спектр услуг по грузоперевозкам',
            'hero_subtitle' => 'От квартирных переездов до доставки строительных материалов — мы решаем любые задачи по транспортировке грузов. Профессиональное оборудование, опытные специалисты и гарантия качества.',
            'calculator_section_title' => 'Доступны в калькуляторе',
            'calculator_section_subtitle' => 'Эти услуги вы можете добавить при расчёте стоимости в онлайн-калькуляторе',
            'other_section_title' => 'Дополнительные услуги',
            'other_section_subtitle' => 'Специализированные услуги под особые требования. Свяжитесь с нами для уточнения деталей',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->command->info('Создана первая опубликованная версия контента страницы "Услуги"');
    }
}
