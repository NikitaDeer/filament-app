<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PricesContent extends Model
{
    use HasFactory;

    protected $table = 'prices_content';

    protected $fillable = [
        'hero_badge',
        'hero_title',
        'hero_subtitle',
        'transport_section_title',
        'transport_section_subtitle',
        'transport_section_icon',
        'options_section_title',
        'options_section_subtitle',
        'options_section_icon',
        'special_section_title',
        'special_section_subtitle',
        'special_section_icon',
        'conditions_section_title',
        'conditions_section_description',
        'conditions_items',
        'is_published',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'conditions_items' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public static function getPublished()
    {
        return Cache::remember('prices_content.published', 3600, function () {
            return self::where('is_published', true)->first();
        });
    }

    protected static function booted()
    {
        static::saving(function ($pricesContent) {
            if ($pricesContent->is_published && $pricesContent->isDirty('is_published')) {
                self::where('is_published', true)
                    ->where('id', '!=', $pricesContent->id)
                    ->update(['is_published' => false]);
                $pricesContent->published_at = now();
            }
        });

        static::saved(function () {
            Cache::forget('prices_content.published');
        });

        static::deleted(function () {
            Cache::forget('prices_content.published');
        });
    }
}
