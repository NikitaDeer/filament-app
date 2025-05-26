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

    protected static ?string $navigationGroup = 'Управление услугами и заявками';

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
                        
                        // TextInput::make('title')
                        //     ->label('Название тарифа')
                        //     ->required(),
                        // Textarea::make('description')
                        //     ->label('Описание'),
                        // TextInput::make('price')
                        //     ->label('Базовая цена (месяц)')
                        //     ->required()
                        //     ->numeric()
                        //     ->prefix('₽'),
                        // Toggle::make('is_published')
                        //     ->label('Опубликовать'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'trial',
                        'success' => 'regular'
                    ]),
                Tables\Columns\TextColumn::make('duration_days'),
                Tables\Columns\TextColumn::make('price')
                    ->money('RUB'),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                
                // TextColumn::make('title')
                //     ->searchable()
                //     ->sortable()
                //     ->label('Название'),
                // TextColumn::make('description')
                //     ->limit(25)
                //     ->label('Описание'),
                // TextColumn::make('price')
                //     ->money('RUB')
                //     ->label('Базовая цена за месяц'),
                // ToggleColumn::make('is_published')
                //     ->label('Опубликован'),
                // TextColumn::make('created_at')
                //     ->dateTime('d.m.Y H:i')
                //     ->label('Создан'),
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
