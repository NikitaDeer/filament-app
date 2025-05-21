<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
