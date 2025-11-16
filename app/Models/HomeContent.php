<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class HomeContent extends Model
{
    use HasFactory;

    protected $table = 'home_content';

    protected $fillable = [
        // Hero
        'hero_title',
        'hero_subtitle',
        'hero_feature1',
        'hero_feature2',
        'hero_feature3',
        'hero_feature4',
        'hero_image',
        
        // Stats
        'stats_clients',
        'stats_clients_label',
        'stats_availability',
        'stats_availability_label',
        'stats_years',
        'stats_years_label',
        
        // Advantages
        'advantages_title',
        'advantages_subtitle',
        'advantages_adv1_title',
        'advantages_adv1_description',
        'advantages_adv2_title',
        'advantages_adv2_description',
        'advantages_adv3_title',
        'advantages_adv3_description',
        
        // About
        'about_title',
        'about_subtitle',
        'about_history_title',
        'about_description1',
        'about_description2',
        
        // Fleet
        'fleet_title',
        'fleet_subtitle',
        
        // Services
        'services_title',
        'services_subtitle',
        
        // Versioning
        'is_published',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Связь с пользователем (кто создал)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope: только опубликованная версия
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Получить опубликованную версию
     */
    public static function getPublished()
    {
        return Cache::remember('home_content.published', 3600, function () {
            return self::where('is_published', true)->first();
        });
    }

    /**
     * Опубликовать эту версию
     */
    public function publish()
    {
        // Снимаем публикацию со всех других версий
        self::where('is_published', true)->update([
            'is_published' => false,
        ]);

        // Публикуем эту версию
        $this->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        // Очищаем кэш
        Cache::forget('home_content.published');
    }

    /**
     * Очистить кэш при сохранении
     */
    protected static function booted()
    {
        // Перед сохранением: если публикуем, снимаем публикацию со всех других
        static::saving(function ($homeContent) {
            if ($homeContent->is_published && $homeContent->isDirty('is_published')) {
                // Снимаем публикацию со всех других версий
                self::where('is_published', true)
                    ->where('id', '!=', $homeContent->id)
                    ->update(['is_published' => false]);
                
                // Устанавливаем дату публикации
                $homeContent->published_at = now();
            }
        });

        static::saved(function () {
            Cache::forget('home_content.published');
        });

        static::deleted(function () {
            Cache::forget('home_content.published');
        });
    }
}
