<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\NotificationChannel;
use Illuminate\Support\Facades\Log;

class YandexMapCalculator extends Component
{
  public $from = '';
  public $to = '';
  public $distance;
  public $cost;
  public $price_per_km = 50;

  protected $listeners = ['calculateRoute' => 'calculateRoute'];

  public function setDistanceAndCost($distance)
  {
    $this->distance = $distance;
    $this->cost = round($distance * $this->price_per_km);
  }

  public function resetAddress($field)
  {
    if ($field === 'from') {
      $this->from = '';
    } elseif ($field === 'to') {
      $this->to = '';
    }
    $this->distance = null;
    $this->cost = null;

    $this->emit('resetAddress', $field);
  }

  public function calculateRoute()
  {
    $this->emit('calculateRoute', [
      'from' => $this->from,
      'to' => $this->to,
      'price_per_km' => $this->price_per_km,
    ]);
  }

  public function render()
  {
    return view('livewire.yandex-map-calculator');
  }
}
