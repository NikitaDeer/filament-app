<?php

namespace App\Filament\Resources\ServiceResource\Widgets;

use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ServiceStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $total = Service::count();
        $published = Service::where('is_published', true)->count();
        $inCalculator = Service::where('is_calculator_option', true)->count();
        $popular = Service::where('is_popular', true)->count();
        $unpublished = $total - $published;

        return [
            Card::make('Всего услуг', $total)
                ->description('Общее количество услуг в системе')
                ->descriptionIcon('heroicon-s-collection')
                ->color('primary'),

            Card::make('Опубликовано', $published)
                ->description($unpublished > 0 ? "{$unpublished} не опубликовано" : 'Все услуги опубликованы')
                ->descriptionIcon('heroicon-s-eye')
                ->color('success'),

            Card::make('В калькуляторе', $inCalculator)
                ->description('Доступны для выбора в калькуляторе')
                ->descriptionIcon('heroicon-s-calculator')
                ->color('warning'),

            Card::make('Популярные', $popular)
                ->description('Отмечены как популярные')
                ->descriptionIcon('heroicon-s-star')
                ->color('danger'),
        ];
    }
}
