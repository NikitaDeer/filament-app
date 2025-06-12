<x-filament::widget class="filament-account-widget">
    <x-filament::card class="relative overflow-hidden bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/50 dark:from-gray-800 dark:via-gray-800/90 dark:to-gray-900 shadow-xl border-0 rounded-3xl p-8 backdrop-blur-sm">
        <!-- Декоративные элементы -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-100/20 to-primary-200/10 dark:from-primary-900/10 dark:to-primary-800/5 rounded-full -translate-y-16 translate-x-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-indigo-100/30 to-blue-100/20 dark:from-indigo-900/10 dark:to-blue-800/5 rounded-full translate-y-12 -translate-x-12 blur-xl"></div>
        
        @php
            $user = \Filament\Facades\Filament::auth()->user();
        @endphp
        
        <div class="relative flex items-center gap-6">
            <!-- аватар с эффектами -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-primary-400 to-indigo-500 rounded-2xl blur-md opacity-20 animate-pulse"></div>
                <x-filament::user-avatar 
                    :user="$user" 
                    class="relative w-16 h-16 ring-4 ring-white/60 dark:ring-gray-700/60 shadow-2xl rounded-2xl backdrop-blur-sm border-2 border-white/20 dark:border-gray-600/20" 
                />
                <!-- Индикатор онлайн статуса -->
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 border-3 border-white dark:border-gray-800 rounded-full shadow-lg animate-pulse"></div>
            </div>
            
            <!-- типографика -->
            <div class="flex-1">
                <h2 class="text-2xl font-bold tracking-tight bg-gradient-to-r from-gray-800 via-gray-700 to-gray-800 dark:from-white dark:via-gray-100 dark:to-white bg-clip-text text-transparent mb-2">
                    {{ __('filament::widgets/account-widget.welcome', ['user' => \Filament\Facades\Filament::getUserName($user)]) }}
                </h2>
                
                <!-- Дополнительная информация -->
                <div class="flex items-center gap-3 mb-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800/50">
                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></div>
                        Онлайн
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                        {{ now()->format('d.m.Y H:i') }}
                    </span>
                </div>
                
                <form action="{{ route('filament.auth.logout') }}" method="post" class="mt-1">
                    @csrf
                    <button
                        type="submit"
                        class="group inline-flex items-center gap-2 text-sm font-medium text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-all duration-300 ease-out hover:gap-3"
                    >
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        {{ __('filament::widgets/account-widget.buttons.logout.label') }}
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">→</span>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Тонкая декоративная линия внизу -->
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-primary-200 dark:via-primary-800 to-transparent"></div>
    </x-filament::card>
</x-filament::widget>