<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\AccessKey;
use App\Models\Subscription;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = auth()->user();
        
        // Загружаем пользователя с нужными связями
        $user->load([
            'currentTariff',
            'activeSubscription.tariff',
            'activeAccessKey',
            'subscriptions.tariff'
        ]);
        
        // Получаем активный ключ с проверкой
        $accessKey = $user->activeAccessKey;
        
        // Получаем все подписки пользователя
        $subscriptions = $user->subscriptions()
            ->with('tariff')
            ->orderBy('created_at', 'desc')
            ->get();

        // Получаем статус подписки
        $subscriptionStatus = $user->getSubscriptionStatus();
    
        return view('profile.edit', [
            'user' => $user,
            'accessKey' => $accessKey,
            'subscriptions' => $subscriptions,
            'subscriptionStatus' => $subscriptionStatus,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Деактивируем все связанные записи перед удалением
        $user->subscriptions()->update(['status' => 'cancelled']);
        $user->accessKeys()->update(['is_active' => false]);
        
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}