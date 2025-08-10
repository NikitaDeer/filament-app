<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RateResource\Pages;
use App\Models\Rate;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class RateResource extends Resource
{
    protected static ?string $model = Rate::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Управление тарифами калькулятора за КМ';

    protected static ?string $navigationLabel = 'Тарифы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название тарифа')
                    ->required(),
                Forms\Components\TextInput::make('price_per_km')
                    ->label('Цена за км')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Активен')
                    ->helperText('Только один тариф может быть активен. При активации этого, другие станут неактивными.')
                    ->afterStateUpdated(function ($state, callable $set, $livewire) {
                        if ($state) {
                            Rate::where('id', '!=', $livewire->record->id ?? null)->update(['is_active' => false]);
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Название'),
                Tables\Columns\TextColumn::make('price_per_km')->label('Цена за км')->money('rub')->formatStateUsing(fn ($state) => number_format($state, 2, ',', ' ') . ' ₽'),
                Tables\Columns\IconColumn::make('is_active')->label('Активен')->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRates::route('/'),
            'create' => Pages\CreateRate::route('/create'),
            'edit' => Pages\EditRate::route('/{record}/edit'),
        ];
    }
}
