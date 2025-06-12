<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\User;
use App\Models\Subscription;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Всего пользователей', User::count())
                ->description('Общее количество зарегистрированных пользователей')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Активные подписки', $this->getActiveSubscriptionsCount())
                ->description('Пользователи с активными подписками')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Пробные периоды', $this->getTrialUsersCount())
                ->description('Пользователи на пробном периоде')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Доход за месяц', number_format($this->getMonthlyRevenue(), 0, '.', ' ') . ' ₽')
                ->description('Общий доход за текущий месяц')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }

    private function getActiveSubscriptionsCount(): int
    {
        return Subscription::where('status', 'active')
            ->where('end_date', '>', now())
            ->count();
    }

    private function getTrialUsersCount(): int
    {
        return User::where('trial_ends_at', '>', now())->count();
    }

    private function getMonthlyRevenue(): float
    {
        return Subscription::where('status', 'active')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('final_price');
    }
}