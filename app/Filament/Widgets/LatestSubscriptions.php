<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Subscription;

class LatestSubscriptions extends BaseWidget
{
    protected static ?string $heading = 'Последние подписки';
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';
    
    protected function getTableQuery(): Builder
    {
        return Subscription::query()
            ->with(['user', 'tariff'])
            ->latest()
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
            
            Tables\Columns\BadgeColumn::make('status')
                ->label('Статус')
                ->colors([
                    'success' => 'active',
                    'danger' => 'expired',
                    'warning' => 'pending',
                    'secondary' => 'cancelled',
                ])
                ->formatStateUsing(fn ($state) => match($state) {
                    'active' => 'Активна',
                    'expired' => 'Истекла',
                    'pending' => 'Ожидание',
                    'cancelled' => 'Отменена',
                    default => $state
                }),
            
            Tables\Columns\TextColumn::make('final_price')
                ->label('Цена')
                ->formatStateUsing(fn ($state) => number_format($state, 0, '.', ' ') . ' ₽')
                ->sortable(),
            
            Tables\Columns\TextColumn::make('created_at')
                ->label('Создана')
                ->dateTime('d.m.Y H:i')
                ->sortable(),
        ];
    }
}