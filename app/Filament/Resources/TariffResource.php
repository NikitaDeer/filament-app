<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tariff;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TariffResource\Pages;

class TariffResource extends Resource
{
    protected static ?string $model = Tariff::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationGroup = 'Управление подписками и тарифами';

    protected static ?string $navigationLabel = 'Предоставляемые тарифы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Предоставляемый тариф')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                        ->required(),
                    Forms\Components\Select::make('type')
                        ->options([
                            'trial' => 'Trial',
                            'regular' => 'Regular'
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('duration_days')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->prefix('RUB')
                        ->required(),
                    Forms\Components\TextInput::make('description'),
                    Forms\Components\Toggle::make('is_renewable'),
                    Forms\Components\Toggle::make('is_published')
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Название'),
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'trial',
                        'success' => 'regular'
                    ])
                    ->label('Тип'),
                Tables\Columns\TextColumn::make('duration_days')
                    ->label('Длительность'),
                Tables\Columns\TextColumn::make('price')
                    ->money('RUB')
                    ->label('Цена'),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Опубликован')
                    ->boolean(),
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTariffs::route('/'),
            'create' => Pages\CreateTariff::route('/create'),
            'edit' => Pages\EditTariff::route('/{record}/edit'),
        ];
    }    
}
