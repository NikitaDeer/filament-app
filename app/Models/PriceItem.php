<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceItem extends Model
{
  use HasFactory;

  protected $fillable = ['price_category_id', 'name', 'price', 'unit'];

  public function category(): BelongsTo
  {
    return $this->belongsTo(PriceCategory::class, 'price_category_id');
  }
}
