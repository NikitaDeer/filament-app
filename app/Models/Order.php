<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'cost', // Старое поле, оставлено для совместимости
        'comment',
        // Новые поля калькулятора
        'vehicle_id',
        'route_points',
        'selected_services',
        'loaders_count',
        'loader_price',
        'passengers_count',
        'passenger_price',
        'floors_count',
        'floor_price',
        'has_cargo_elevator',
        'estimated_hours',
        'base_distance_cost',
        'base_time_cost',
        'services_cost',
        'options_cost',
        'total_cost',
    ];

  protected $casts = [
    'route_points' => 'array',
    'selected_services' => 'array',
    'loaders_count' => 'integer',
    'passengers_count' => 'integer',
    'floors_count' => 'integer',
    'has_cargo_elevator' => 'boolean',
    'loader_price' => 'decimal:2',
    'passenger_price' => 'decimal:2',
    'floor_price' => 'decimal:2',
    'estimated_hours' => 'decimal:2',
    'distance' => 'decimal:2',
    'base_distance_cost' => 'decimal:2',
    'base_time_cost' => 'decimal:2',
    'services_cost' => 'decimal:2',
            'options_cost' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'cost' => 'decimal:2',
        ];

  /**
   * Получить автомобиль заказа
   */
  public function vehicle(): BelongsTo
  {
    return $this->belongsTo(Vehicle::class);
  }

  /**
   * Получить выбранные услуги
   */
  public function services()
  {
    if (empty($this->selected_services)) {
      return collect([]);
    }
    return Service::whereIn('id', $this->selected_services)->get();
  }
}
