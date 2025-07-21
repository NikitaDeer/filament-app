<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'phone',
    'email',
    'from_address',
    'to_address',
    'distance',
    'cost',
    'comment',
  ];
}
