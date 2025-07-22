<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Services\RsaEncryptionService;
use App\Http\Controllers\SubscriptionController;
use App\Models\Order;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\NotificationChannel;
use Illuminate\Support\Facades\Log;

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

// Тестовый маршрут для проверки отправки email
Route::get('/test-email', function () {
  // Создаем тестовый заказ
  $order = new Order();
  $order->name = 'Тестовый клиент';
  $order->phone = '+7 999 123-45-67';
  $order->email = 'test@example.com';
  $order->from_address = 'Москва, Красная площадь';
  $order->to_address = 'Санкт-Петербург, Невский проспект';
  $order->distance = 700;
  $order->cost = 35000;
  $order->save();

  try {
    // Получаем активный email канал уведомлений
    $emailChannel = NotificationChannel::where('type', 'email')
      ->where('is_active', true)
      ->first();

    // Если нет настроенного канала, используем адрес по умолчанию
    $emailTo = $emailChannel ? $emailChannel->value : 'nikita@dergunov.info';

    // Отправляем уведомление на email администратора
    Mail::to($emailTo)->send(new NewOrderMail($order));

    return 'Email успешно отправлен на адрес: ' . $emailTo . ' с информацией о заказе #' . $order->id;
  } catch (\Exception $e) {
    return 'Ошибка отправки email: ' . $e->getMessage();
  }
});

Route::get('/test-encryption', function () {
  try {
    $service = new \App\Services\RsaEncryptionService();
    $testData = 'Hello, this is test data!';

    echo "Исходные данные: " . $testData . "<br>";

    $encrypted = $service->encrypt($testData);
    echo "Зашифровано: " . substr($encrypted, 0, 100) . "...<br>";

    $decrypted = $service->decrypt($encrypted);
    echo "Расшифровано: " . $decrypted . "<br>";

    if ($testData === $decrypted) {
      echo "<strong style='color: green;'>✅ ТЕСТ ПРОШЕЛ УСПЕШНО!</strong>";
    } else {
      echo "<strong style='color: red;'>❌ ТЕСТ НЕ ПРОШЕЛ!</strong>";
    }

  } catch (\Exception $e) {
    echo "<strong style='color: red;'>Ошибка: " . $e->getMessage() . "</strong><br>";
    echo "Trace: <pre>" . $e->getTraceAsString() . "</pre>";
  }
})->name('test.encryption');

Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::post('/profile/validate-current-password', [ProfileController::class, 'validateCurrentPassword'])
    ->name('profile.validate-current-password');

  Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

  // Маршрут для активации тарифа
  Route::post('/tariffs/{tariff}/activate', [SubscriptionController::class, 'activate'])
    ->middleware('auth')
    ->name('tariffs.activate');

  // resource routes
  Route::resources(
    [
      'orders' => App\Http\Controllers\OrderController::class,
    ]
  );



  Route::post('/subscribe/{tariffId}', [SubscriptionController::class, 'subscribe'])
    ->name('subscribe');

  Route::get('/access-key', function () {
    $accessKey = auth()->user()->accessKeys()->latest()->first();
    return view('access-key', ['accessKey' => $accessKey]);
  })->name('access-key.show');

  Route::get('/test-service', function () {
    $service = new RsaEncryptionService();
    $encrypted = $service->encrypt('test_data');
    $decrypted = $service->decrypt($encrypted);
    return "Работает! Расшифровано: " . $decrypted;
  });



});

Route::get('/style-guide', function () {
    return view('style-guide');
})->name('style-guide');

require __DIR__ . '/auth.php';
