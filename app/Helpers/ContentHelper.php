<?php

use App\Models\HomeContent;
use Illuminate\Support\Facades\Cache;

if (!function_exists('home_content')) {
    /**
     * Получить опубликованный контент главной страницы
     *
     * @param string $field Название поля (например, 'hero_title')
     * @param string $default Значение по умолчанию
     * @return string|null
     */
    function home_content($field, $default = '')
    {
        $content = HomeContent::getPublished();
        return $content?->$field ?? $default;
    }
}

if (!function_exists('home_image')) {
    /**
     * Получить URL изображения главной страницы
     *
     * @param string $field Название поля изображения (например, 'hero_image')
     * @param string $default Путь по умолчанию
     * @return string|null
     */
    function home_image($field, $default = '')
    {
        $content = HomeContent::getPublished();
        $imagePath = $content?->$field;

        if ($imagePath) {
            return \Storage::url($imagePath);
        }

        return $default;
    }
}
