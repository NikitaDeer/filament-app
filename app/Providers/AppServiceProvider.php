<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\NotificationChannels\Telegram\Telegram::class, function () {
            return new \NotificationChannels\Telegram\Telegram(
                config('services.telegram-bot-api.token'),
                new \GuzzleHttp\Client(['verify' => false]),
                config('services.telegram-bot-api.base_uri')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/filament.css');
        });
    }
}