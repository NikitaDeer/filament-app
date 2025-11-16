<?php

namespace Database\Seeders;

use App\Models\ContactsContent;
use Illuminate\Database\Seeder;

class ContactsContentSeeder extends Seeder
{
    public function run(): void
    {
        ContactsContent::create([
            'hero_title' => 'Свяжитесь с нами',
            'hero_subtitle' => 'Мы всегда рады помочь. Выберите удобный для вас способ связи, и мы ответим в кратчайшие сроки.',
            'address_title' => 'Наш офис',
            'address_line1' => 'г. Санкт-Петербург,',
            'address_line2' => 'Невский проспект, д. 28',
            'support_title' => 'Поддержка',
            'support_phone' => '+7 (812) 123-45-67',
            'support_email' => 'support@spbcargo.ru',
            'hours_title' => 'Режим работы',
            'hours_weekdays' => 'Пн-Пт: 9:00-21:00',
            'hours_weekend' => 'Сб-Вс: 10:00-18:00',
            'social_title' => 'Мы в соцсетях',
            'social_vk' => 'https://vk.com/spbcargo',
            'social_telegram' => 'https://t.me/spbcargo_bot',
            'social_whatsapp' => '+79123456789',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->command->info('Создана первая опубликованная версия контента страницы "Контакты"');
    }
}
