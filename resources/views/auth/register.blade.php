{{-- header --}}
<x-site.header />

<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto w-16 h-16 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg mb-6">
                    <i class="fas fa-user-plus text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-cyan-800">
                    Создать аккаунт
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Присоединяйтесь к нам и получите доступ ко всем возможностям
                </p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Логин')" class="block text-sm font-medium text-cyan-800 mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-cyan-400"></i>
                            </div>
                            <x-text-input id="name" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-colors bg-gray-50 hover:bg-white" 
                                type="text" 
                                name="name" 
                                :value="old('name')" 
                                required 
                                autofocus 
                                autocomplete="name"
                                placeholder="Введите ваше имя" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
                    </div>

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
                                autocomplete="username"
                                placeholder="Введите ваш email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Пароль')" class="block text-sm font-medium text-cyan-800 mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-key text-cyan-400"></i>
                            </div>
                            <x-text-input id="password" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-colors bg-gray-50 hover:bg-white"
                                type="password"
                                name="password"
                                required 
                                autocomplete="new-password"
                                placeholder="Создайте надежный пароль" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')" class="block text-sm font-medium text-cyan-800 mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-shield-check text-cyan-400"></i>
                            </div>
                            <x-text-input id="password_confirmation" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-colors bg-gray-50 hover:bg-white"
                                type="password"
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="Подтвердите ваш пароль" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Password Requirements -->
                    <div class="bg-cyan-50 rounded-lg p-4">
                        <p class="text-sm text-cyan-800 font-medium mb-2">Требования к паролю:</p>
                        <ul class="text-xs text-cyan-700 space-y-1">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-cyan-500 mr-2"></i>
                                Минимум 8 символов
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-cyan-500 mr-2"></i>
                                Содержит буквы и цифры
                            </li>
                        </ul>
                    </div>

                    <!-- Submit Button -->
                    <div class="space-y-4">
                        <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-400 font-medium transition-all duration-200 transform hover:scale-[1.02]">
                            <i class="fas fa-user-plus mr-2"></i>
                            {{ __('Создать аккаунт') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        Уже есть аккаунт? 
                        <a href="{{ route('login') }}" 
                           class="font-medium text-cyan-600 hover:text-cyan-800 transition-colors">
                            Войти
                        </a>
                    </p>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    Регистрируясь, вы соглашаетесь с нашими 
                    <a href="#" class="text-cyan-600 hover:text-cyan-800">условиями использования</a>
                    и 
                    <a href="#" class="text-cyan-600 hover:text-cyan-800">политикой конфиденциальности</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>

{{-- footer --}}
<x-site.footer />