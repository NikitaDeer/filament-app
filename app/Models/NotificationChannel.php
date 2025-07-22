<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationChannel extends Model
{
    use HasFactory;
    
    /**
     * Атрибуты, которые можно массово назначать.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'value',
        'is_active',
        'is_default',
    ];
    
    /**
     * Атрибуты, которые должны быть приведены к определенным типам.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];
    
    /**
     * Получить все активные каналы уведомлений.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getActiveChannels()
    {
        return self::where('is_active', true)->get();
    }
    
    /**
     * Получить канал уведомлений по умолчанию.
     *
     * @return \App\Models\NotificationChannel|null
     */
    public static function getDefaultChannel()
    {
        return self::where('is_default', true)->first();
    }
    
    /**
     * Получить все каналы уведомлений типа email.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getEmailChannels()
    {
        return self::where('type', 'email')->where('is_active', true)->get();
    }
}
