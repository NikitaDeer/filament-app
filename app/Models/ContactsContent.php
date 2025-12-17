<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ContactsContent extends Model
{
    use HasFactory;

    protected $table = 'contacts_content';

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'support_title',
        'support_phone',
        'support_email',
        'hours_title',
        'hours_weekdays',
        'hours_weekend',
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
        return Cache::remember('contacts_content.published', 3600, function () {
            return self::where('is_published', true)->first();
        });
    }

    protected static function booted()
    {
        static::saving(function ($contactsContent) {
            if ($contactsContent->is_published && $contactsContent->isDirty('is_published')) {
                self::where('is_published', true)
                    ->where('id', '!=', $contactsContent->id)
                    ->update(['is_published' => false]);
                $contactsContent->published_at = now();
            }
        });

        static::saved(function () {
            Cache::forget('contacts_content.published');
        });

        static::deleted(function () {
            Cache::forget('contacts_content.published');
        });
    }
}
