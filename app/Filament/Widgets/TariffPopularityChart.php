<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Filament\Widgets\ChartWidget;

class TariffPopularityChart extends ChartWidget
{
    protected static ?string $heading = 'Популярность тарифов';
    protected static ?int $sort = 4;
    protected static ?string $maxHeight = '300px';

    protected int | string | array $columnSpan = 'full';
    

    protected function getData(): array
    {
        $tariffData = Subscription::join('tariffs', 'subscriptions.tariff_id', '=', 'tariffs.id')
            ->selectRaw('tariffs.title, COUNT(*) as count')
            ->where('subscriptions.status', 'active')
            ->groupBy('tariffs.id', 'tariffs.title')
            ->get();

        $count = $tariffData->count();
        
        return [
            'datasets' => [
                [
                    'data' => $tariffData->pluck('count')->toArray(),
                    'backgroundColor' => $this->generateColors($count),
                    'borderWidth' => 1,
                    'borderColor' => '#ffffff',
                    'hoverBorderWidth' => 2,
                    'hoverBorderColor' => '#374151',
                ],
            ],
            'labels' => $tariffData->pluck('title')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'cutout' => '60%',
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                        'padding' => 15,
                        'font' => [
                            'size' => 12,
                        ],
                        'color' => '#6B7280',
                    ],
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(17, 24, 39, 0.8)',
                    'titleColor' => '#F3F4F6',
                    'bodyColor' => '#F3F4F6',
                    'borderColor' => '#374151',
                    'borderWidth' => 1,
                    'cornerRadius' => 6,
                    'displayColors' => true,
                    'callbacks' => [
                        'label' => 'function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed * 100) / total).toFixed(1);
                            return context.label + ": " + context.parsed + " (" + percentage + "%)";
                        }'
                    ],
                ],
            ],
            'elements' => [
                'arc' => [
                    'borderRadius' => 4,
                ],
            ],
            'animation' => [
                'animateRotate' => true,
                'animateScale' => true,
                'duration' => 1000,
            ],
        ];
    }

    /**
     * Генерирует массив приглушенных цветов для заданного количества элементов
     */
    private function generateColors(int $count): array
    {
        $baseColors = [
            'rgba(99, 102, 241, 0.8)',   // Индиго
            'rgba(16, 185, 129, 0.8)',   // Изумрудный
            'rgba(245, 158, 11, 0.8)',   // Янтарный
            'rgba(139, 92, 246, 0.8)',   // Фиолетовый
            'rgba(236, 72, 153, 0.8)',   // Розовый
            'rgba(34, 197, 94, 0.8)',    // Зеленый
            'rgba(249, 115, 22, 0.8)',   // Оранжевый
            'rgba(20, 184, 166, 0.8)',   // Бирюзовый
            'rgba(168, 85, 247, 0.8)',   // Пурпурный
            'rgba(14, 165, 233, 0.8)',   // Голубой
        ];

        if ($count <= count($baseColors)) {
            return array_slice($baseColors, 0, $count);
        }

        // Если тарифов больше, чем базовых цветов, генерируем дополнительные
        $colors = $baseColors;
        for ($i = count($baseColors); $i < $count; $i++) {
            $hue = ($i * 137.508) % 360; // Золотое сечение для равномерного распределения
            $colors[] = "hsla($hue, 65%, 60%, 0.8)";
        }

        return array_slice($colors, 0, $count);
    }
}