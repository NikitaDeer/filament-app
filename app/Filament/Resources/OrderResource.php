<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use App\Models\Tariff;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Управление услугами и заявками';

    protected static ?string $navigationLabel = 'Заявки клиентов';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'email')
                    ->required()
                    ->label('Выберите пользователя'),
                Forms\Components\Select::make('tariff_id')
                    ->relationship('tariff', 'title')
                    ->required()
                    ->label('Выберите тариф'),
                Forms\Components\Select::make('duration')
                    ->options([
                        '1_month' => '1 месяц',
                        '3_months' => '3 месяца (-10%)',
                        '12_months' => '12 месяцев (-20%)',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        if ($get('tariff_id')) {
                            $tariff = Tariff::find($get('tariff_id'));
                            $finalPrice = $tariff->calculatePrice($state);
                            $set('final_price', $finalPrice);
                        }
                    })
                    ->label('Длительность'),
                Forms\Components\TextInput::make('final_price')
                    ->disabled()
                    ->label('Итоговая цена')
                    ->prefix('₽'),
                Forms\Components\Select::make('order_status')
                    ->options([
                        'active' => 'Активен',
                        'non-active' => 'Не активен',
                        'paused' => 'Приостановлен'
                    ])
                    ->default('active')
                    ->required()
                    ->label('Статус заявки'),
            ]);
    }

    protected static function afterCreate($record): void
    {
        // Обновляем текущий тариф пользователя
        $record->user->update([
            'current_tariff_id' => $record->tariff_id,
            'tariff_status' => 'active'
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('user.email')
                    ->label('Email пользователя')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tariff.title')
                    ->label('Тариф')
                    ->sortable(),
                TextColumn::make('duration')
                    ->label('Длительность')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '1_month' => '1 месяц',
                        '3_months' => '3 месяца',
                        '12_months' => '12 месяцев',
                    }),
                TextColumn::make('final_price')
                    ->label('Стоимость')
                    ->money('RUB'),
                BadgeColumn::make('order_status')
                    ->label('Статус')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'non-active',
                        'warning' => 'paused',
                    ]),
                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('order_status')
                    ->options([
                        'active' => 'Активен',
                        'non-active' => 'Не активен',
                        'paused' => 'Приостановлен'
                    ])
                    ->label('Статус')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }    
}