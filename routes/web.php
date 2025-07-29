<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
})->name('home');

Route::get('/services', function () {
  return view('pages.services.index');
})->name('services.index');

Route::get('/style-guide', function () {
  return view('style-guide');
})->name('style-guide');

Route::get('/calculator', function () {
  return view('pages.calculator.index');
})->name('calculator.index');

require __DIR__ . '/auth.php';
