<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Subscription;

class ExpiringSubscriptions extends BaseWidget
{
    protected static ?string $heading = 'Истекающие подписки (ближайшие 7 дней)';
    protected static ?int $sort = 6;
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Subscription::query()
            ->with(['user', 'tariff'])
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->where('end_date', '<=', now()->addDays(7))
            ->orderBy('end_date', 'asc')
            ->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.email')
                ->label('Пользователь')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('tariff.title')
                ->label('Тариф')
                ->sortable(),
            
            Tables\Columns\TextColumn::make('end_date')
                ->label('Истекает')
                ->dateTime('d.m.Y H:i')
                ->color('danger')
                ->sortable(),
            
            Tables\Columns\BadgeColumn::make('remaining_days')
                ->label('Осталось дней')
                ->getStateUsing(function ($record) {
                    return $record->remainingDays();
                })
                ->colors([
                    'danger' => static fn ($state): bool => $state <= 1,
                    'warning' => static fn ($state): bool => $state <= 3,
                    'success' => static fn ($state): bool => $state > 3,
                ]),
        ];
    }
}