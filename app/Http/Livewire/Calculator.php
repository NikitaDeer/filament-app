<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Calculator extends Component
{
  public $distance = 0;
  public $weight = 0;
  public $volume = 0;
  public $transportType = 'small';
  public $cost = 0;

  protected $rules = [
    'distance' => 'required|numeric|min:0',
    'weight' => 'required|numeric|min:0',
    'volume' => 'required|numeric|min:0',
    'transportType' => 'required|in:small,medium,large',
  ];

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
    $this->calculateCost();
  }

  public function calculateCost()
  {
    $this->validate();

    $baseRate = 0;
    switch ($this->transportType) {
      case 'small':
        $baseRate = 50;
        break;
      case 'medium':
        $baseRate = 75;
        break;
      case 'large':
        $baseRate = 100;
        break;
    }

    $distanceCost = $this->distance * 2;
    $weightCost = $this->weight * 5;
    $volumeCost = $this->volume * 10;

    $this->cost = $baseRate + $distanceCost + $weightCost + $volumeCost;
  }


  public function render()
  {
    return view('livewire.calculator');
  }
}
