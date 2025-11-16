<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AboutContent extends Model
{
    use HasFactory;

    protected $table = 'about_content';

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'why_title',
        'why_description1',
        'why_description2',
        'why_feature1',
        'why_feature2',
        'why_feature3',
        'stat1_number',
        'stat1_label',
        'stat2_number',
        'stat2_label',
        'stat3_number',
        'stat3_label',
        'stat4_number',
        'stat4_label',
        'value1_title',
        'value1_description',
        'value2_title',
        'value2_description',
        'value3_title',
        'value3_description',
        'value4_title',
        'value4_description',
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
        return Cache::remember('about_content.published', 3600, function () {
            return self::where('is_published', true)->first();
        });
    }

    public function publish()
    {
        self::where('is_published', true)->update(['is_published' => false]);
        $this->update([
            'is_published' => true,
            'published_at' => now(),
        ]);
        Cache::forget('about_content.published');
    }

    protected static function booted()
    {
        static::saving(function ($aboutContent) {
            if ($aboutContent->is_published && $aboutContent->isDirty('is_published')) {
                self::where('is_published', true)
                    ->where('id', '!=', $aboutContent->id)
                    ->update(['is_published' => false]);
                $aboutContent->published_at = now();
            }
        });

        static::saved(function () {
            Cache::forget('about_content.published');
        });

        static::deleted(function () {
            Cache::forget('about_content.published');
        });
    }
}
