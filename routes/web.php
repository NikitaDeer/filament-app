<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
})->name('home');

Route::get('/services', function () {
  return view('pages.services.index');
})->name('services.index');

require __DIR__ . '/auth.php';
