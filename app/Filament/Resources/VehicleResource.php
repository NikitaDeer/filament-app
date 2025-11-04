<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Транспорт';

    protected static ?string $modelLabel = 'Транспорт';

    protected static ?string $pluralModelLabel = 'Транспорт';

    protected static ?string $navigationGroup = 'Калькулятор';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название транспорта')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->maxLength(1000)
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('allows_passengers')
                    ->label('Можно брать пассажиров')
                    ->default(false),

                Forms\Components\TextInput::make('price_per_km')
                    ->label('Цена за км (₽)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01),

                Forms\Components\TextInput::make('price_per_hour')
                    ->label('Цена за час (₽)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01),

                Forms\Components\TextInput::make('capacity_tons')
                    ->label('Грузоподъемность (тонн)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01),

                Forms\Components\TextInput::make('length_m')
                    ->label('Длина (м)')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01),

                Forms\Components\TextInput::make('width_m')
                    ->label('Ширина (м)')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01),

                Forms\Components\TextInput::make('height_m')
                    ->label('Высота (м)')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01),

                Forms\Components\Toggle::make('is_active')
                    ->label('Активен')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('capacity_tons')
                    ->label('Грузоподъемность')
                    ->suffix(' т')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_km')
                    ->label('Цена/км')
                    ->money('RUB')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_hour')
                    ->label('Цена/час')
                    ->money('RUB')
                    ->sortable(),

                Tables\Columns\IconColumn::make('allows_passengers')
                    ->label('Пассажиры')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активные')
                    ->placeholder('Все')
                    ->trueLabel('Только активные')
                    ->falseLabel('Только неактивные'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('name', 'asc');
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
