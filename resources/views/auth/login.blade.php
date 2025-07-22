{{-- header --}}
<x-site.header />
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto w-16 h-16 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg mb-6">
                    <i class="fas fa-lock text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-cyan-800">
                    Добро пожаловать!
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Войдите в свой аккаунт
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-cyan-800 mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-cyan-400"></i>
                            </div>
                            <x-text-input id="email" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-colors bg-gray-50 hover:bg-white" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autofocus 
                                autocomplete="username"
                                placeholder="Введите ваш email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-cyan-800 mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-key text-cyan-400"></i>
                            </div>
                            <x-text-input id="password" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-colors bg-gray-50 hover:bg-white"
                                type="password"
                                name="password"
                                required 
                                autocomplete="current-password"
                                placeholder="Введите ваш пароль" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" 
                                type="checkbox" 
                                class="h-4 w-4 rounded border-gray-300 text-cyan-600 focus:ring-cyan-400 focus:ring-2" 
                                name="remember">
                            <span class="ml-2 text-sm text-gray-700">{{ __('Запомнить меня') }}</span>
                        </label>

                        <!-- @if (Route::has('password.request'))
                            <a class="text-sm text-cyan-600 hover:text-cyan-800 font-medium transition-colors" 
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif -->
                    </div>

                    <!-- Submit Button -->
                    <div class="space-y-4">
                        <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-400 font-medium transition-all duration-200 transform hover:scale-[1.02]">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            {{ __('Войти') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        Нет аккаунта? 
                        <a href="{{ route('register') }}" 
                           class="font-medium text-cyan-600 hover:text-cyan-800 transition-colors">
                            Зарегистрироваться
                        </a>
                    </p>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    Входя в систему, вы соглашаетесь с нашими 
                    <a href="#" class="text-cyan-600 hover:text-cyan-800">условиями использования</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
{{-- footer --}}
<x-site.footer />