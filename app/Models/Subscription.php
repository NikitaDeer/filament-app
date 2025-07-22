<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    // Константы для статусов
    const STATUS_ACTIVE = 'active';
    const STATUS_EXPIRED = 'expired';
    const STATUS_PENDING = 'pending';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'tariff_id',
        'start_date',
        'end_date',
        'status',
        'final_price'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    public function accessKey()
    {
        return $this->hasOne(AccessKey::class);
    }

    public function progressPercentage()
    {
        $totalDays = $this->start_date->diffInDays($this->end_date);
        $elapsedDays = $this->start_date->diffInDays(now());
        
        // Защита от деления на ноль и отрицательных значений
        if ($totalDays <= 0) {
            return 0;
        }
        
        $percentage = ($elapsedDays / $totalDays) * 100;
        
        // Ограничиваем значение от 0 до 100
        return min(100, max(0, $percentage));
    }

    // Метод для проверки активности подписки
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE && $this->end_date->isFuture();
    }

    // Метод для проверки отмененной подписки
    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    // Метод для получения оставшихся дней
    public function remainingDays()
    {
        if ($this->end_date->isPast()) {
            return 0;
        }
        
        return $this->end_date->diffInDays(now());
    }

    // Метод для получения всех доступных статусов
    public static function getAvailableStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'Активная',
            self::STATUS_EXPIRED => 'Истекшая',
            self::STATUS_PENDING => 'Ожидание',
            self::STATUS_CANCELLED => 'Отменена',
        ];
    }
}