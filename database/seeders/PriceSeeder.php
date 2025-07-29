<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Price;

class PriceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Price::truncate();

    $prices = [
      // Тарифы
      [
        'name' => 'Эконом',
        'description' => 'Базовая доставка',
        'price' => 1500,
        'price_prefix' => 'от',
        'price_suffix' => 'Р',
        'category' => 'Тарифы',
        'features' => json_encode(['Газель до 1.5 т', 'Водитель', 'Базовая страховка', 'Работа в будни']),
        'is_popular' => false,
        'order' => 10,
      ],
      [
        'name' => 'Стандарт',
        'description' => 'Популярный выбор',
        'price' => 2500,
        'price_prefix' => 'от',
        'price_suffix' => 'Р',
        'category' => 'Тарифы',
        'features' => json_encode(['Газель + 2 грузчика', 'Упаковочные материалы', 'Подъем на этаж', 'Работа в выходные', 'Расширенная страховка']),
        'is_popular' => true,
        'order' => 20,
      ],
      [
        'name' => 'Премиум',
        'description' => 'Полный сервис',
        'price' => 4000,
        'price_prefix' => 'от',
        'price_suffix' => 'Р',
        'category' => 'Тарифы',
        'features' => json_encode(['Грузовик + 3 грузчика', 'Разборка/сборка мебели', 'Упаковка всех вещей', 'Утилизация упаковки', 'Полная страховка', 'Работа 24/7']),
        'is_popular' => false,
        'order' => 30,
      ],

      // Транспорт
      ['name' => 'Газель (до 1.5 т)', 'description' => 'Минимум 2 часа', 'price' => 800, 'price_suffix' => 'Р/час', 'category' => 'Транспорт', 'order' => 40],
      ['name' => 'Грузовик 3 т', 'description' => 'Минимум 2 часа', 'price' => 1200, 'price_suffix' => 'Р/час', 'category' => 'Транспорт', 'order' => 50],
      ['name' => 'Грузовик 5 т', 'description' => 'Минимум 2 часа', 'price' => 1500, 'price_suffix' => 'Р/час', 'category' => 'Транспорт', 'order' => 60],
      ['name' => 'Грузовик 10 т', 'description' => 'Минимум 3 часа', 'price' => 2000, 'price_suffix' => 'Р/час', 'category' => 'Транспорт', 'order' => 70],

      // Грузчики
      ['name' => '1 грузчик', 'description' => 'Минимум 2 часа', 'price' => 500, 'price_suffix' => 'Р/час', 'category' => 'Грузчики', 'order' => 80],
      ['name' => '2 грузчика', 'description' => 'Минимум 2 часа', 'price' => 900, 'price_suffix' => 'Р/час', 'category' => 'Грузчики', 'order' => 90],
      ['name' => '3 грузчика', 'description' => 'Минимум 2 часа', 'price' => 1300, 'price_suffix' => 'Р/час', 'category' => 'Грузчики', 'order' => 100],
      ['name' => '4 грузчика', 'description' => 'Минимум 2 часа', 'price' => 1600, 'price_suffix' => 'Р/час', 'category' => 'Грузчики', 'order' => 110],

      // Дополнительные услуги
      ['name' => 'Упаковка вещей', 'description' => 'Материалы включены', 'price' => 50, 'price_suffix' => 'Р/коробка', 'category' => 'Дополнительные услуги', 'order' => 120],
      ['name' => 'Разборка мебели', 'description' => 'За единицу мебели', 'price' => 300, 'price_suffix' => 'Р/час', 'category' => 'Дополнительные услуги', 'order' => 130],
      ['name' => 'Сборка мебели', 'description' => 'За единицу мебели', 'price' => 400, 'price_suffix' => 'Р/час', 'category' => 'Дополнительные услуги', 'order' => 140],
      ['name' => 'Подъем на этаж', 'description' => 'За тонну груза', 'price' => 100, 'price_suffix' => 'Р/этаж', 'category' => 'Дополнительные услуги', 'order' => 150],
      ['name' => 'Утилизация упаковки', 'description' => 'Фиксированная цена', 'price' => 200, 'price_suffix' => 'Р', 'category' => 'Дополнительные услуги', 'order' => 160],
      ['name' => 'Страхование груза', 'description' => 'Опционально', 'price' => 2, 'price_suffix' => '% от стоимости', 'category' => 'Дополнительные услуги', 'order' => 170],

      // Межгород
      ['name' => 'По Ленинградской области', 'description' => 'В одну сторону', 'price' => 25, 'price_suffix' => 'Р/км', 'category' => 'Межгород', 'order' => 180],
      ['name' => 'До Москвы', 'description' => 'В зависимости от груза', 'price' => 15000, 'price_prefix' => 'от', 'price_suffix' => 'Р', 'category' => 'Межгород', 'order' => 190],
      ['name' => 'До Новгорода', 'description' => 'В зависимости от груза', 'price' => 8000, 'price_prefix' => 'от', 'price_suffix' => 'Р', 'category' => 'Межгород', 'order' => 200],
      ['name' => 'До Пскова', 'description' => 'В зависимости от груза', 'price' => 12000, 'price_prefix' => 'от', 'price_suffix' => 'Р', 'category' => 'Межгород', 'order' => 210],
    ];

    foreach ($prices as $price) {
      Price::create($price);
    }
  }
}
