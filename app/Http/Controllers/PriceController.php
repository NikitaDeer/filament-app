<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;

class PriceController extends Controller
{
  public function index()
  {
    $prices = Price::orderBy('order')->get();

    $tariffs = $prices->where('category', 'Тарифы');
    $transport = $prices->where('category', 'Транспорт');
    $movers = $prices->where('category', 'Грузчики');
    $additionalServices = $prices->where('category', 'Дополнительные услуги');
    $intercity = $prices->where('category', 'Межгород');

    return view('pages.pricing.index', compact('tariffs', 'transport', 'movers', 'additionalServices', 'intercity'));
  }
}
