<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope: только опубликованные вопросы
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope: по категории
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Получить все категории с подсчетом вопросов
     */
    public static function getCategoriesWithCount()
    {
        return self::select('category', \DB::raw('count(*) as count'))
            ->where('is_published', true)
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();
    }
}
