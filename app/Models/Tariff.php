<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
      ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
