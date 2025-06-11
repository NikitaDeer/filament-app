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

    // Акцессор для расчета оставшегося времени
    public function remainingPercentage()
    {
        $totalDays = $this->generated_at->diffInDays($this->expires_at);
        $remainingDays = $this->expires_at->diffInDays(now());
        return ($remainingDays / $totalDays) * 100;
    }

    public function generateKey(User $user, Subscription $subscription)
    {
        // Формируем данные для шифрования
        $data = json_encode([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'start_date' => $subscription->start_date->timestamp,
            'end_date' => $subscription->end_date->timestamp,
            'tariff' => $subscription->tariff->only(['title', 'duration_days']),
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
