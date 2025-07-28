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
  ];

  protected $casts = [
    'features' => 'array',
    'is_published' => 'boolean',
  ];

  public function product()
  {
    return $this->hasMany(Order::class);
  }
}
