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

    public function edit(Request $request): View
    {

        $user = auth()->user();
        $accessKey = $user->accessKeys()
            ->where('is_active', true)
            ->latest()
            ->first();
        $subscriptions = $user->subscriptions()
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('profile.edit', [
            'user' => $user,
            'accessKey' => $accessKey ?? null, // Явное указание null
            'subscriptions' => $subscriptions ?? collect(), // Пустая коллекция
        ]);

        // $user = $request->user();
        // $accessKey = $user->accessKeys()
        //     ->where('is_active', true)
        //     ->latest('generated_at')
        //     ->first();
        
        // $subscriptions = $user->subscriptions()
        //     ->with('tariff')
        //     ->get();
    
        // return view('profile.edit', compact('user', 'accessKey', 'subscriptions'));
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
