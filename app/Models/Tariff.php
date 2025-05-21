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
        'type',
        'duration_days',
        'price',
        'description',
        'is_published',
        'is_renewable'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_renewable' => 'boolean',
        'duration_days' => 'integer',
    ];

    // public function calculatePrice(string $duration): float
    // {
    //     $discount = match($duration) {
    //         '3_months' => 0.10, // 10% скидка
    //         '12_months' => 0.20, // 20% скидка
    //         default => 0,
    //     };

    //     return $this->price * (1 - $discount);
    // }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'current_tariff_id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public static function trialTariff()
    {
        return static::where('type', 'trial')->first();
    }
}
