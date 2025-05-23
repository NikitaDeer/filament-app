<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //         'subscriptions' => $request->user()->subscriptions,
    //     ]);
    // }

    public function edit(Request $request): View
    {
        $user = $request->user();
        $key = $user->accessKeys()->first(); // Исправлено на accessKeys()
        $subscriptions = $user->subscriptions;
    
        return view('profile.edit', compact('user', 'key', 'subscriptions'));
    }

    // public function edit(Request $request): View
    // {
    //     $user = $request->user();
    //     $key = $user->accessKey;
    //     $subscriptions = $user->subscriptions;
    
    //     return view('profile.edit', compact('user', 'key', 'subscriptions'));
    // }

    // public function edit(Request $request): View
    // {
    //     $user = $request->user();
    
    //     // Получаем текущий ключ пользователя
    //     $accessKey = $user->accessKey; // например, связь hasOne
    
    //     // Получаем историю подписок (если есть)
    //     $subscriptions = $user->subscriptions; // например, связь hasMany
    
    //     return view('profile.edit', compact('user', 'accessKey', 'subscriptions'));
    // }

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
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
