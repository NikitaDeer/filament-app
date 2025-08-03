<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'price',
    'description',
    'features',
    'is_published',
    'is_popular',
  ];

  protected $casts = [
    'features' => 'array',
    'is_published' => 'boolean',
    'is_popular' => 'boolean',
  ];

  public function product()
  {
    return $this->hasMany(Order::class);
  }
}
