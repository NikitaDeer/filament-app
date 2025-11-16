<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ServicesContent extends Model
{
    use HasFactory;

    protected $table = 'services_content';

    protected $fillable = [
        'hero_badge',
        'hero_title',
        'hero_subtitle',
        'calculator_section_title',
        'calculator_section_subtitle',
        'other_section_title',
        'other_section_subtitle',
        'is_published',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
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
        return Cache::remember('services_content.published', 3600, function () {
            return self::where('is_published', true)->first();
        });
    }

    protected static function booted()
    {
        static::saving(function ($servicesContent) {
            if ($servicesContent->is_published && $servicesContent->isDirty('is_published')) {
                self::where('is_published', true)
                    ->where('id', '!=', $servicesContent->id)
                    ->update(['is_published' => false]);
                $servicesContent->published_at = now();
            }
        });

        static::saved(function () {
            Cache::forget('services_content.published');
        });

        static::deleted(function () {
            Cache::forget('services_content.published');
        });
    }
}
