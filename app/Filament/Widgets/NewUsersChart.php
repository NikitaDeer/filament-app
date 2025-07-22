<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class NewUsersChart extends ChartWidget
{
    protected static ?string $heading = 'Новые пользователи (30 дней)';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';

    protected int | string | array $columnSpan = '6';


    protected function getData(): array
    {
        $data = Trend::model(User::class)
            ->between(now()->subDays(30), now())
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Пользователи',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'borderColor' => '#8B5CF6',
                    'backgroundColor' => 'rgba(139, 92, 246, 0.2)',
                    'pointBackgroundColor' => '#8B5CF6',
                    'pointRadius' => 4,
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['color' => '#6B7280'],
                    'grid' => ['color' => '#E5E7EB'],
                ],
                'x' => [
                    'ticks' => ['color' => '#6B7280'],
                    'grid' => ['display' => false],
                ],
            ],
            'plugins' => [
                'legend' => ['display' => false],
                'tooltip' => [
                    'backgroundColor' => '#1F2937',
                    'titleColor' => '#F3F4F6',
                    'bodyColor' => '#F3F4F6',
                    'cornerRadius' => 6,
                    'borderColor' => '#374151',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
