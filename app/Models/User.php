<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telegram_id',
        'trial_used',
        'trial_ends_at',
        'current_tariff_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'telegram_id' => 'integer',
        'trial_used' => 'boolean',
        'trial_ends_at' => 'datetime',
    ];

    public function canAccessFilament(): bool
    {
        return $this->hasRole('Admin');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Отношения для подписок
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function accessKeys(): HasMany
    {
        return $this->hasMany(AccessKey::class);
    }

    // Активная подписка
    public function activeSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->latest('created_at');
    }

    // Текущий тариф
    public function currentTariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class, 'current_tariff_id');
    }

    // Текущая подписка (альтернативный метод)
    public function currentSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->latest('created_at');
    }

    // Активный ключ доступа
    public function activeAccessKey(): HasOne
    {
        return $this->hasOne(AccessKey::class)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->latest('generated_at');
    }

    // Методы проверки статуса
    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscription()->exists();
    }

    public function hasActiveAccessKey(): bool
    {
        return $this->activeAccessKey()->exists();
    }

    // Получить статус подписки
    public function getSubscriptionStatus()
    {
        $activeSubscription = $this->activeSubscription;
        
        if ($activeSubscription && $activeSubscription->status === 'active') {
            return [
                'status' => 'active',
                'tariff' => $activeSubscription->tariff,
                'end_date' => $activeSubscription->end_date,
                'subscription' => $activeSubscription
            ];
        }
        
        if ($this->trial_ends_at && $this->trial_ends_at->isFuture()) {
            return [
                'status' => 'trial',
                'end_date' => $this->trial_ends_at
            ];
        }
        
        return [
            'status' => 'inactive'
        ];
    }
}