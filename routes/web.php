<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceController;

Route::get('/', function () {
  return view('home');
})->name('home');

Route::get('/services', function () {
  return view('pages.services.index');
})->name('services.index');

Route::get('/style-guide', function () {
  return view('style-guide');
})->name('style-guide');

Route::get('/about', function () {
  return view('pages.about.index');
})->name('about.index');

Route::get('/calculator', function () {
  return view('pages.calculator.index');
})->name('calculator.index');

Route::get('/prices', [PriceController::class, 'index'])->name('prices');

require __DIR__ . '/auth.php';
