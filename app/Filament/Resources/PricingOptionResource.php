<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricingOptionResource\Pages;
use App\Filament\Resources\PricingOptionResource\RelationManagers;
use App\Models\PricingOption;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PricingOptionResource extends Resource
{
    protected static ?string $model = PricingOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Ценообразование';

    protected static ?string $modelLabel = 'Ценовая опция';

    protected static ?string $pluralModelLabel = 'Ценовые опции';

    protected static ?string $navigationGroup = 'Калькулятор';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Тип опции')
                    ->options([
                        'loader' => 'Грузчики',
                        'passenger' => 'Пассажиры',
                        'floor' => 'Этажи',
                    ])
                    ->required()
                    ->reactive(),

                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->maxLength(1000)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('price_per_hour')
                    ->label('Цена за час (₽)')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->visible(fn (callable $get) => in_array($get('type'), ['loader', 'passenger']))
                    ->required(fn (callable $get) => in_array($get('type'), ['loader', 'passenger'])),

                Forms\Components\TextInput::make('price_per_floor')
                    ->label('Цена за этаж (₽)')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->visible(fn (callable $get) => $get('type') === 'floor')
                    ->required(fn (callable $get) => $get('type') === 'floor'),

                Forms\Components\TextInput::make('max_quantity')
                    ->label('Максимальное количество')
                    ->numeric()
                    ->minValue(1)
                    ->default(10)
                    ->required()
                    ->helperText('Максимальное количество, которое можно выбрать в калькуляторе'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Активна')
                    ->default(true)
                    ->helperText('При активации этой записи, другие активные записи того же типа будут деактивированы')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, $livewire) {
                        // При активации деактивируем другие записи того же типа
                        if ($state && $get('type')) {
                            \App\Models\PricingOption::where('type', $get('type'))
                                ->where('id', '!=', $livewire->record->id ?? 0)
                                ->update(['is_active' => false]);
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Тип')
                    ->enum([
                        'loader' => 'Грузчики',
                        'passenger' => 'Пассажиры',
                        'floor' => 'Этажи',
                    ])
                    ->colors([
                        'primary' => 'loader',
                        'success' => 'passenger',
                        'warning' => 'floor',
                    ]),

                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_hour')
                    ->label('Цена/час')
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, '.', ' ') . ' ₽' : '—')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_floor')
                    ->label('Цена/этаж')
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, '.', ' ') . ' ₽' : '—')
                    ->sortable(),

                Tables\Columns\TextColumn::make('max_quantity')
                    ->label('Макс.')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Тип')
                    ->options([
                        'loader' => 'Грузчики',
                        'passenger' => 'Пассажиры',
                        'floor' => 'Этажи',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активные')
                    ->placeholder('Все')
                    ->trueLabel('Только активные')
                    ->falseLabel('Только неактивные'),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle_active')
                    ->label('Активировать')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => !$record->is_active)
                    ->requiresConfirmation()
                    ->modalHeading('Активировать эту опцию?')
                    ->modalSubheading(fn ($record) => 'Другие активные опции типа "' . $record->type . '" будут деактивированы')
                    ->action(function ($record) {
                        // Деактивируем все записи этого типа
                        \App\Models\PricingOption::where('type', $record->type)
                            ->where('id', '!=', $record->id)
                            ->update(['is_active' => false]);

                        // Активируем текущую
                        $record->update(['is_active' => true]);

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Опция активирована')
                            ->body('Все другие опции этого типа были деактивированы')
                            ->send();
                    }),

                Tables\Actions\Action::make('toggle_inactive')
                    ->label('Деактивировать')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->is_active)
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['is_active' => false]);

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Опция деактивирована')
                            ->send();
                    }),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('type', 'asc');
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
            'index' => Pages\ListPricingOptions::route('/'),
            'create' => Pages\CreatePricingOption::route('/create'),
            'edit' => Pages\EditPricingOption::route('/{record}/edit'),
        ];
    }
}
