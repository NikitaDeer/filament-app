<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Tariff;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => ['nullable', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],  
    ]);

    // $emptyTariff = Tariff::where('title', 'Нет тарифа')->first();

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'tariff_status' => 'non-active'

    ]);

    //todo: переделать код создания ролей
    $user->assignRole('User');

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
  }
}