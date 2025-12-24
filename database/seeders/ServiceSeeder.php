<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Удаляем старые записи
        Service::truncate();

        $services = [
            [
                'name' => 'Упаковка мебели',
                'description' => 'Профессиональная упаковка мебели в стрейч-пленку и воздушно-пузырьковую пленку для безопасной транспортировки',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => true,
                'features' => ['Стрейч-пленка', 'Воздушно-пузырьковая пленка', 'Картонные уголки', 'Защита от царапин'],
                'icon' => 'fas fa-box',
            ],
            [
                'name' => 'Разборка/сборка мебели',
                'description' => 'Разборка и последующая сборка корпусной мебели на новом месте',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => false,
                'features' => ['Профессиональные инструменты', 'Опытные мастера', 'Быстрая сборка', 'Гарантия качества'],
                'icon' => 'fas fa-tools',
            ],
            [
                'name' => 'Утилизация старой мебели',
                'description' => 'Вывоз и утилизация ненужной мебели, строительного мусора',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => false,
                'features' => ['Вынос из квартиры', 'Погрузка в транспорт', 'Официальная утилизация', 'Уборка территории'],
                'icon' => 'fas fa-trash',
            ],
            [
                'name' => 'Страхование груза',
                'description' => 'Полное страхование груза на время перевозки от повреждений и утраты. Стоимость рассчитывается индивидуально.',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => false,
                'features' => ['Защита от повреждений', 'Покрытие утраты', 'Быстрое оформление', 'Официальный договор'],
                'icon' => 'fas fa-shield-alt',
            ],
            [
                'name' => 'Экспресс-доставка',
                'description' => 'Доставка в течение 2 часов с момента заказа. Подача транспорта в приоритетном порядке.',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => true,
                'features' => ['Подача за 2 часа', 'Приоритетная обработка', 'Гарантированное время', 'Круглосуточно'],
                'icon' => 'fas fa-bolt',
            ],
            [
                'name' => 'Упаковочные материалы',
                'description' => 'Предоставление упаковочных материалов: картонные коробки, пленка, скотч, бумага',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => false,
                'features' => ['Картонные коробки', 'Упаковочная пленка', 'Скотч', 'Упаковочная бумага'],
                'icon' => 'fas fa-boxes',
            ],
            [
                'name' => 'Такелажные работы',
                'description' => 'Подъем/спуск негабаритных грузов с использованием специального оборудования',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => false,
                'features' => ['Специальное оборудование', 'Профессиональная бригада', 'Безопасность груза', 'Страховка'],
                'icon' => 'fas fa-hard-hat',
            ],
            [
                'name' => 'Хранение груза',
                'description' => 'Временное хранение груза на охраняемом складе',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => false,
                'features' => ['Охраняемый склад', 'Видеонаблюдение', 'Чистое помещение', 'Круглосуточный доступ'],
                'icon' => 'fas fa-warehouse',
            ],
            [
                'name' => 'Погрузчик (кран-манипулятор)',
                'description' => 'Аренда крана-манипулятора для погрузки тяжелых грузов',
                'price' => 0,
                'pricing_type' => 'hourly',
                'is_published' => true,
                'is_popular' => false,
                'features' => ['Грузоподъемность до 10 тонн', 'Опытный оператор', 'Работа на высоте', 'Безопасность'],
                'icon' => 'fas fa-truck-loading',
            ],
            [
                'name' => 'Междугородняя перевозка',
                'description' => 'Доставка грузов в другие города и регионы. Стоимость рассчитывается индивидуально в зависимости от расстояния и объема груза.',
                'price' => 0,
                'pricing_type' => 'fixed',
                'is_published' => true,
                'is_popular' => false,
                'features' => ['По всей России', 'Отслеживание груза', 'Документы на груз', 'Страхование в пути'],
                'icon' => 'fas fa-road',
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }
}

