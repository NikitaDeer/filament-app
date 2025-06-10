<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'tariff_status'
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
    ];

    public function canAccessFilament(): bool
    {
        return $this->hasRole('Admin');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function currentTariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class, 'current_tariff_id');
    }

    // Новые отношения
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function accessKeys()
    {
        return $this->hasMany(AccessKey::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->latestOfMany();
    }

    // Новые методы
    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscription()->exists();
    }

}
