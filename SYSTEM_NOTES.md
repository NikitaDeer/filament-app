# 📋 Системные заметки по проекту "СПБ Карго"

**Дата последнего обновления:** 16.11.2025

---

## 📌 О проекте

**Название:** СПБ Карго - Система грузоперевозок  
**Технологии:** Laravel 10, Filament PHP 3, Livewire, Alpine.js, Tailwind CSS  
**База данных:** SQLite  
**Назначение:** Сайт компании по грузоперевозкам с онлайн-калькулятором и CMS

---

## 🎯 Основной план действий на будущее

### ✅ Выполнено:
1. ✅ Создана полная CMS система для всех страниц
2. ✅ Реализован калькулятор с Yandex Maps API
3. ✅ Система управления транспортом, услугами, опциями
4. ✅ Версионность контента (черновики + опубликованная версия)
5. ✅ Админ-панель Filament для всех сущностей

### 🔄 В процессе / Планируется:
1. ⏳ FAQ система (создать миграции, модели, страницу)
2. ⏳ Полезная информация (советы по перевозке)
3. ⏳ Улучшение UX калькулятора
4. ⏳ Добавление галереи изображений
5. ⏳ SEO оптимизация
6. ⏳ Аналитика заказов

---

## 🏗️ Архитектура CMS системы

### Принцип работы:
- **Одна таблица = одна страница сайта**
- **Несколько строк в таблице = разные версии (черновики)**
- **Только одна строка с `is_published = true` отображается на сайте**
- **Версионность реализована через механизм черновиков**

### Созданные таблицы:

#### 1. `home_content` - Главная страница
**Поля:**
- Hero: `hero_title`, `hero_subtitle`, `hero_feature1-4`, `hero_image`
- Статистика: `stats_clients`, `stats_availability`, `stats_years` + labels
- Преимущества: `advantages_title`, `advantages_subtitle`, `advantages_adv1-3_title`, `advantages_adv1-3_description`
- О компании: `about_title`, `about_subtitle`, `about_history_title`, `about_description1-2`
- Автопарк: `fleet_title`, `fleet_subtitle`
- Услуги: `services_title`, `services_subtitle`

**Helper функция:** `home_content($field, $default)`, `home_image($field, $default)`

#### 2. `about_content` - О компании
**Поля:**
- Hero: `hero_title`, `hero_subtitle`
- Почему нас: `why_title`, `why_description1-2`, `why_feature1-3`
- Статистика: `stat1-4_number`, `stat1-4_label`
- Ценности: `value1-4_title`, `value1-4_description`

**Helper функция:** `about_content($field, $default)`

#### 3. `services_content` - Услуги
**Поля:**
- Hero: `hero_badge`, `hero_title`, `hero_subtitle`
- Секции: `calculator_section_title`, `calculator_section_subtitle`, `other_section_title`, `other_section_subtitle`

**Helper функция:** `services_content($field, $default)`

#### 4. `fleet_content` - Автопарк
**Поля:**
- Hero: `hero_title`, `hero_subtitle`

**Helper функция:** `fleet_content($field, $default)`

#### 5. `prices_content` - Цены
**Поля:**
- Hero: `hero_badge`, `hero_title`, `hero_subtitle`
- Секции: `transport_section_title`, `options_section_title`, `special_section_title`, `conditions_section_title` + subtitles/descriptions

**Helper функция:** `prices_content($field, $default)`

#### 6. `contacts_content` - Контакты
**Поля:**
- Hero: `hero_title`, `hero_subtitle`
- Адрес: `address_title`, `address_line1-2`
- Поддержка: `support_title`, `support_phone`, `support_email`
- Часы работы: `hours_title`, `hours_weekdays`, `hours_weekend`
- Соцсети: `social_title`, `social_vk`, `social_telegram`, `social_whatsapp`

**Helper функция:** `contacts_content($field, $default)`

---

## 📂 Структура Filament Resources

### Контент сайта (navigationGroup = 'Контент сайта'):
1. **HomeContentResource** - Главная страница (sort: 1)
2. **AboutContentResource** - О компании (sort: 2)
3. **ServicesContentResource** - Услуги (sort: 3)
4. **FleetContentResource** - Автопарк (sort: 4)
5. **PricesContentResource** - Цены (sort: 5)
6. **ContactsContentResource** - Контакты (sort: 6)

### Основные сущности:
- **VehicleResource** - Транспорт
- **ServiceResource** - Услуги (с toggle для калькулятора)
- **PricingOptionResource** - Опции (грузчики, этажи, пассажиры)
- **OrderResource** - Заказы

---

## 🔧 Важные технические детали

### Версионность контента:
```php
// В каждой модели (HomeContent, AboutContent, etc.)
protected static function booted()
{
    static::saving(function ($content) {
        if ($content->is_published && $content->isDirty('is_published')) {
            // Снимаем публикацию со всех других версий
            self::where('is_published', true)
                ->where('id', '!=', $content->id)
                ->update(['is_published' => false]);
            $content->published_at = now();
        }
    });

    static::saved(function () {
        Cache::forget('content.published');
    });
}
```

### Кэширование:
```php
public static function getPublished()
{
    return Cache::remember('home_content.published', 3600, function () {
        return self::where('is_published', true)->first();
    });
}
```

### Helper функции в `app/Helpers/ContentHelper.php`:
```php
home_content($field, $default = '')
about_content($field, $default = '')
services_content($field, $default = '')
fleet_content($field, $default = '')
prices_content($field, $default = '')
contacts_content($field, $default = '')
home_image($field, $default = '')
```

---

## 📝 Последние изменения

### 16.11.2025 - Полная переделка CMS системы
- ❌ Удалена старая сложная система с `content_blocks` и `content_versions`
- ✅ Создана новая простая система: 1 таблица = 1 страница
- ✅ Реализована версионность через черновики (несколько строк в таблице)
- ✅ Создано 6 таблиц для контента: home, about, services, fleet, prices, contacts
- ✅ Созданы модели с автоматическим управлением публикацией
- ✅ Созданы Filament Resources для каждой страницы
- ✅ Созданы seeders с дефолтными данными
- ✅ Обновлены все blade файлы для использования helper функций
- ✅ Добавлено кэширование контента для оптимизации

### Ранее выполненные задачи:
- ✅ Калькулятор с каруселью транспорта (4 авто на экране)
- ✅ Drag & Drop для точек маршрута
- ✅ Модальное окно с деталями адреса (подъезд, этаж, квартира, домофон, телефон)
- ✅ Страница "Цены" с таблицами и реальными данными
- ✅ Улучшенная админка для услуг (toggle, select для иконок, bulk actions)
- ✅ Разделение услуг на "В калькуляторе" и "Дополнительные"
- ✅ Исправлены ошибки с increment/decrement кнопками в калькуляторе
- ✅ Автоматический пересчет цены при выборе услуг

---

## 🐛 Известные проблемы и решения

### Проблема 1: Ошибка с PricingOption типами
**Описание:** CHECK constraint failed: type  
**Решение:** Изменен тип колонки с enum на string, типы переведены на русский: 'грузчики', 'пассажиры', 'этажи'  
**Файл:** `database/migrations/2025_11_04_151409_create_pricing_options_table.php`

### Проблема 2: Doctrine DBAL warnings
**Описание:** Call to undefined method createSchemaManager()  
**Решение:** Это warning, не критично. Filament не может прочитать схему для auto-generate, но ресурсы создаются корректно  
**Действие:** Игнорировать, заполнять ресурсы вручную

### Проблема 3: Composer autoload
**Описание:** Failed to open stream для helper файла  
**Решение:** Запустить `composer dump-autoload` после изменения `composer.json`  
**Файл:** `composer.json` в секции `autoload.files`

---

## 📊 Статистика проекта

**Таблицы в БД:** 22  
**Filament Resources:** 11  
**Models:** 15  
**Seeders:** 9  
**Миграции:** 28  
**Blade компоненты:** 6  
**Helper функции:** 7  

---

## 🎨 Дизайн и UX

### Цветовая схема:
- **Основной цвет:** Зеленый (#16a34a - green-600)
- **Акцент:** Темно-зеленый (#15803d - green-700)
- **Фон светлая тема:** Белый, серый-50
- **Фон темная тема:** Серый-900, серый-800

### Принципы UX:
- Минималистичный дизайн
- Карточки с hover эффектами (translate-y)
- Адаптивность на всех устройствах
- Dark mode поддержка
- Иконки FontAwesome и Heroicons

---

## 🔐 Доступ к админке

**URL:** `/admin`  
**Email:** `admin@example.com`  
**Password:** `password`  
**Роль:** Admin (полный доступ)

---

## 📦 Основные зависимости

```json
{
  "laravel/framework": "^10.0",
  "filament/filament": "^3.0",
  "livewire/livewire": "^3.0",
  "spatie/laravel-permission": "^5.0",
  "akaunting/laravel-money": "^4.0"
}
```

---

## 🚀 Команды для разработки

### Запуск сервера:
```bash
php artisan serve
```

### Очистка кэша:
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Миграции:
```bash
php artisan migrate
php artisan migrate:fresh --seed  # С очисткой БД
```

### Seeders:
```bash
php artisan db:seed
php artisan db:seed --class=HomeContentSeeder
```

### Autoload:
```bash
composer dump-autoload
```

---

## 📝 Заметки для будущего

### TODO - Высокий приоритет:
1. [ ] Создать FAQ систему (таблица, модель, ресурс, страница)
2. [ ] Добавить Полезную информацию (советы по перевозке)
3. [ ] Реализовать блок FAQ на главной странице (топ 5 вопросов)
4. [ ] Добавить возможность загрузки изображений для всех страниц
5. [ ] Создать Gallery модель для фотогалереи работ

### TODO - Средний приоритет:
1. [ ] Dashboard с виджетами статистики
2. [ ] Email уведомления о новых заказах
3. [ ] Экспорт заказов в Excel
4. [ ] Фильтры и поиск в админке заказов
5. [ ] История изменений заказов

### TODO - Низкий приоритет:
1. [ ] Интеграция с платежными системами
2. [ ] Личный кабинет клиента
3. [ ] Система отзывов
4. [ ] Блог/Новости
5. [ ] Мультиязычность

### Идеи для улучшения:
- Добавить breadcrumbs на все страницы
- Реализовать систему скидок и промокодов
- Создать мобильное приложение
- Добавить онлайн-чат с оператором
- Интеграция с CRM системой

---

## 📚 Полезные ссылки

- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Yandex Maps API](https://yandex.ru/dev/maps)

---

## 🔄 История версий

**v1.0.0** (16.11.2025) - Первая стабильная версия с полной CMS системой  
**v0.9.0** (15.11.2025) - Реализация калькулятора и админки  
**v0.5.0** (10.11.2025) - Базовая структура проекта

---

**Последнее обновление:** 16 ноября 2025, 19:55

