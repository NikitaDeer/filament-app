<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\AccessKey;
use App\Models\User;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, $tariffId)
    {
        $user = auth()->user();
        $tariff = Tariff::findOrFail($tariffId);

        try {
            DB::beginTransaction();

            // Деактивируем старые подписки и ключи
            $user->subscriptions()->update(['status' => 'expired']);
            $user->accessKeys()->update(['is_active' => false]);

            // Создаем подписку
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'tariff_id' => $tariff->id,
                'start_date' => now(),
                'end_date' => now()->addDays($tariff->duration_days),
                'status' => 'active',
                'final_price' => $tariff->price,
            ]);

            // Обновляем текущий тариф пользователя
            $user->update(['current_tariff_id' => $tariff->id]);

            // Генерируем ключ
            $accessKey = new AccessKey([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
            ]);

            $accessKey->generateKey($user, $subscription);

            DB::commit();

            return redirect()->route('profile.edit')
                ->with('success', 'Подписка успешно оформлена! Ваш ключ доступа находится в личном кабинете.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Произошла ошибка при оформлении подписки: ' . $e->getMessage());
        }
    }

    public function activate(Request $request, Tariff $tariff)
    {
        $user = $request->user();
        
        try {
            DB::beginTransaction();

            // Деактивируем старые подписки и ключи
            $user->subscriptions()->update(['status' => 'expired']);
            $user->accessKeys()->update(['is_active' => false]);
            
            // Создаем новую подписку
            $subscription = $user->subscriptions()->create([
                'tariff_id' => $tariff->id,
                'start_date' => now(),
                'end_date' => now()->addDays($tariff->duration_days),
                'status' => 'active',
                'final_price' => $tariff->price,
            ]);

            // Обновляем текущий тариф пользователя
            $user->update(['current_tariff_id' => $tariff->id]);
        
            // Генерируем ключ
            $accessKey = new AccessKey([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'is_active' => true,
            ]);
            
            // Генерируем ключ с сохранением
            $accessKey->generateKey($user, $subscription);

            DB::commit();
        
            return redirect()->route('profile.edit')
                ->with('success', 'Тариф успешно активирован! Ваш ключ доступа готов.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Произошла ошибка при активации тарифа: ' . $e->getMessage());
        }
    }
}