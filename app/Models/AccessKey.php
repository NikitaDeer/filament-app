<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\RsaEncryptionService;

class AccessKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'encrypted_key',
        'generated_at',
        'expires_at',
        'is_active'
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Отношения
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    // Акцессор для дешифровки
    public function getDecryptedKeyAttribute(): string
    {
        try {
            return Crypt::decryptString($this->encrypted_key);
        } catch (\Exception $e) {
            return 'Invalid key';
        }
    }

    // Акцессор для расчета оставшегося времени в процентах
    public function remainingPercentage()
    {
        if (!$this->generated_at || !$this->expires_at) {
            return 0;
        }

        $totalDays = $this->generated_at->diffInDays($this->expires_at);
        $remainingDays = now()->diffInDays($this->expires_at, false); // false для получения отрицательных значений если истек
        
        // Защита от деления на ноль
        if ($totalDays <= 0) {
            return 0;
        }
        
        // Если ключ истек
        if ($remainingDays < 0) {
            return 0;
        }
        
        $percentage = ($remainingDays / $totalDays) * 100;
        
        // Ограничиваем значение от 0 до 100
        return min(100, max(0, $percentage));
    }

    // Метод для получения оставшихся дней
    public function remainingDays()
    {
        if (!$this->expires_at || $this->expires_at->isPast()) {
            return 0;
        }
        
        return $this->expires_at->diffInDays(now());
    }

    // Проверка активности ключа
    public function isActive()
    {
        return $this->is_active && $this->expires_at && $this->expires_at->isFuture();
    }

    public function generateKey(User $user, Subscription $subscription)
    {
        // Формируем данные для шифрования
        $data = json_encode([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'subscription_id' => $subscription->id,
            'start_date' => $subscription->start_date->timestamp,
            'end_date' => $subscription->end_date->timestamp,
            'tariff' => $subscription->tariff->only(['id', 'title', 'duration_days']),
            'generated_at' => now()->timestamp,
        ]);
    
        // Шифруем данные
        $rsaService = new RsaEncryptionService();
        $this->encrypted_key = $rsaService->encrypt($data);
        $this->generated_at = now();
        $this->expires_at = $subscription->end_date;
        $this->is_active = true;
        
        // Сохраняем модель
        $this->save();
    }
}