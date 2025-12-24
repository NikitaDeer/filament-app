<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем первую опубликованную версию
        HomeContent::create([
            // Hero
            'hero_title' => 'Надежные грузоперевозки в СПБ и ЛО',
            'hero_subtitle' => 'Быстро, безопасно и по честной цене. Рассчитайте стоимость доставки за 30 секунд с помощью нашего калькулятора.',
            'hero_feature1' => 'Работаем 24/7',
            'hero_feature2' => 'Опытные грузчики',
            'hero_feature3' => 'Бережная транспортировка',
            'hero_feature4' => 'Фиксированные цены',
            'hero_image' => null,
            
            // Stats
            'stats_clients' => '500+',
            'stats_clients_label' => 'Довольных клиентов',
            'stats_availability' => '24/7',
            'stats_availability_label' => 'Работаем круглосуточно',
            'stats_years' => '5 лет',
            'stats_years_label' => 'Опыт работы',
            
            // Advantages
            'advantages_title' => 'Почему выбирают нас',
            'advantages_subtitle' => 'Мы предоставляем качественные услуги по доступным ценам',
            'advantages_adv1_title' => 'Скорость и сроки',
            'advantages_adv1_description' => 'Гарантируем доставку в установленные сроки благодаря отлаженной логистике.',
            'advantages_adv2_title' => 'Безопасность груза',
            'advantages_adv2_description' => 'Полная материальная ответственность и гарантия сохранности каждого отправления.',
            'advantages_adv3_title' => 'Поддержка 24/7',
            'advantages_adv3_description' => 'Наши менеджеры всегда на связи и готовы ответить на любые ваши вопросы.',
            
            // About
            'about_title' => 'О компании СПБ Карго',
            'about_subtitle' => 'Мы специализируемся на грузоперевозках в Санкт-Петербурге и Ленинградской области. Наша миссия — сделать перевозку грузов простой, надежной и доступной для каждого.',
            'about_history_title' => '5 лет на рынке грузоперевозок',
            'about_description1' => 'За это время мы выполнили более 10,000 заказов и заслужили доверие сотен клиентов. Мы понимаем, что каждый груз важен, поэтому относимся к каждому заказу с максимальной ответственностью.',
            'about_description2' => 'Наша команда состоит из опытных профессионалов, которые знают город как свои пять пальцев и всегда найдут оптимальный маршрут для вашего груза.',
            
            // Fleet
            'fleet_title' => 'Наш автопарк',
            'fleet_subtitle' => 'Современный парк грузовых автомобилей для перевозки любых грузов. От компактных газелей до крупнотоннажных фур.',
            
            // Services
            'services_title' => 'Наши услуги',
            'services_subtitle' => 'Предоставляем полный спектр услуг по грузоперевозкам для частных лиц и малого бизнеса в Санкт-Петербурге и области.',
            
            // Versioning
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->command->info('Создана первая опубликованная версия контента главной страницы');
    }
}
