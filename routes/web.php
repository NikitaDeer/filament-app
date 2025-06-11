<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Services\RsaEncryptionService;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//   return view('main');
// });

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  
// Маршрут для активации тарифа
  Route::post('/tariffs/{tariff}/activate', [SubscriptionController::class, 'activate'])
    ->middleware('auth')
    ->name('tariffs.activate');

  // resource routes
  Route::resources(
    [
      'orders'      => App\Http\Controllers\OrderController::class,
    ]
  );



  Route::post('/subscribe/{tariffId}', [SubscriptionController::class, 'subscribe'])
    ->name('subscribe');

  Route::get('/access-key', function () {
    $accessKey = auth()->user()->accessKeys()->latest()->first();
    return view('access-key', ['accessKey' => $accessKey]);
  })->name('access-key.show');

  Route::get('/test-service', function() {
    $service = new RsaEncryptionService();
    $encrypted = $service->encrypt('test_data');
    $decrypted = $service->decrypt($encrypted);
    return "Работает! Расшифровано: " . $decrypted;
});



});

require __DIR__ . '/auth.php';