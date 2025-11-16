<?php

use App\Models\HomeContent;
use App\Models\AboutContent;
use App\Models\ServicesContent;
use App\Models\FleetContent;
use App\Models\PricesContent;
use App\Models\ContactsContent;
use Illuminate\Support\Facades\Cache;

if (!function_exists('home_content')) {
    function home_content($field, $default = '')
    {
        $content = HomeContent::getPublished();
        return $content?->$field ?? $default;
    }
}

if (!function_exists('home_image')) {
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

if (!function_exists('about_content')) {
    function about_content($field, $default = '')
    {
        $content = AboutContent::getPublished();
        return $content?->$field ?? $default;
    }
}

if (!function_exists('services_content')) {
    function services_content($field, $default = '')
    {
        $content = ServicesContent::getPublished();
        return $content?->$field ?? $default;
    }
}

if (!function_exists('fleet_content')) {
    function fleet_content($field, $default = '')
    {
        $content = FleetContent::getPublished();
        return $content?->$field ?? $default;
    }
}

if (!function_exists('prices_content')) {
    function prices_content($field, $default = '')
    {
        $content = PricesContent::getPublished();
        return $content?->$field ?? $default;
    }
}

if (!function_exists('contacts_content')) {
    function contacts_content($field, $default = '')
    {
        $content = ContactsContent::getPublished();
        return $content?->$field ?? $default;
    }
}
