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
