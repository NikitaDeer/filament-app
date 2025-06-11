<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\AccessKey;
use App\Models\User;
use App\Models\Tariff;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, $tariffId)
    {
        $user = auth()->user();
        $tariff = Tariff::findOrFail($tariffId);

        // Создаем подписку
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'tariff_id' => $tariff->id,
            'start_date' => now(),
            'end_date' => now()->addDays($tariff->duration_days),
            'status' => 'active',
            'final_price' => $tariff->price,
        ]);

        // Генерируем ключ
        $accessKey = new AccessKey([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
        ]);

        $accessKey->generateKey($user, $subscription);

        return redirect()->route('access-key.show')
            ->with('success', 'Подписка активирована!');
    }

    public function activate(Request $request, Tariff $tariff)
    {
        $user = $request->user();
        
        // Деактивируем старые подписки
        $user->subscriptions()->update(['status' => 'expired']);
        
        // Создаем новую подписку
        $subscription = $user->subscriptions()->create([
            'tariff_id' => $tariff->id,
            'start_date' => now(),
            'end_date' => now()->addDays($tariff->duration_days),
            'status' => 'active',
            'final_price' => $tariff->price,
        ]);
    
        // Генерируем ключ
        $accessKey = new AccessKey([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'is_active' => true,
        ]);
        
        // Генерируем ключ с сохранением
        $accessKey->generateKey($user, $subscription);
    
        return redirect()->route('profile.edit')
            ->with('success', 'Тариф активирован!');
    }
}