<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function calculatePrice(string $duration): float
    {
        $discount = match($duration) {
            '3_months' => 0.10, // 10% скидка
            '12_months' => 0.20, // 20% скидка
            default => 0,
        };

        return $this->price * (1 - $discount);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'current_tariff_id');
    }
}
