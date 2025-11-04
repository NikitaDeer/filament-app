<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'allows_passengers',
        'max_passengers',
        'price_per_hour',
        'price_per_km',
        'capacity_tons',
        'length_m',
        'width_m',
        'height_m',
        'image',
        'is_active',
        'sort_order',
    ];
    
    protected $appends = ['image_url'];

    protected $casts = [
        'allows_passengers' => 'boolean',
        'is_active' => 'boolean',
        'price_per_hour' => 'decimal:2',
        'price_per_km' => 'decimal:2',
        'capacity_tons' => 'decimal:2',
        'length_m' => 'decimal:2',
        'width_m' => 'decimal:2',
        'height_m' => 'decimal:2',
        'max_passengers' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Получить заказы для данного автомобиля
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Скоуп для получения только активных автомобилей
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Скоуп для сортировки по sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
    
    /**
     * Get the image URL accessor
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return \Storage::url($this->image);
        }
        return url('/images/default-vehicle.png');
    }
}

