<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description',
        'price_per_hour',
        'price_per_floor',
        'max_quantity',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_per_hour' => 'decimal:2',
        'price_per_floor' => 'decimal:2',
        'max_quantity' => 'integer',
    ];

    /**
     * Скоуп для получения только активных опций
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Скоуп для получения опций по типу
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Получить опции для грузчиков
     */
    public static function loaders()
    {
        return static::active()->ofType('loader')->get();
    }

    /**
     * Получить опции для пассажиров
     */
    public static function passengers()
    {
        return static::active()->ofType('passenger')->get();
    }

    /**
     * Получить опции для этажей
     */
    public static function floors()
    {
        return static::active()->ofType('floor')->get();
    }
}

