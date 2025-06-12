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
use Illuminate\Validation\ValidationException;

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
        try {
            $validated = $request->validated();
            
            // Дополнительная проверка текущего пароля
            if (!Hash::check($validated['current_password'], $request->user()->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['Текущий пароль неверен.'],
                ]);
            }
            
            // Проверяем, что новый пароль отличается от текущего
            if (Hash::check($validated['password'], $request->user()->password)) {
                throw ValidationException::withMessages([
                    'password' => ['Новый пароль должен отличаться от текущего.'],
                ]);
            }
            
            // Обновляем пароль
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
            
            // Логируем изменение пароля для безопасности
            \Log::info('Password updated for user', [
                'user_id' => $request->user()->id,
                'email' => $request->user()->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return back()->with('status', 'password-updated');
            
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Error updating password: ' . $e->getMessage(), [
                'user_id' => $request->user()?->id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['password' => 'Произошла ошибка при обновлении пароля.']);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            // Деактивируем все связанные записи перед удалением
            $user->subscriptions()->update(['status' => Subscription::STATUS_CANCELLED]);
            
            // Проверяем есть ли у пользователя ключи доступа
            if ($user->accessKeys()->exists()) {
                $user->accessKeys()->update(['is_active' => false]);
            }

            // Логируем удаление аккаунта
            \Log::info('User account deleted', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            Auth::logout();
            
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Если это AJAX запрос, возвращаем JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Аккаунт успешно удален'
                ]);
            }

            return Redirect::to('/')->with('status', 'account-deleted');

        } catch (ValidationException $e) {
            // Если это AJAX запрос, возвращаем JSON с ошибками
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }

            // Для обычных запросов возвращаем как обычно
            throw $e;
        } catch (\Exception $e) {
            // Логируем ошибку
            \Log::error('Error deleting user account: ' . $e->getMessage(), [
                'user_id' => $request->user()?->id,
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Произошла ошибка при удалении аккаунта. Попробуйте позже.'
                ], 500);
            }

            return back()->withErrors(['password' => 'Произошла ошибка при удалении аккаунта.']);
        }
    }
}