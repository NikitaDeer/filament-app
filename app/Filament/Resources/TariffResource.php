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
use Illuminate\Database\Eloquent\SoftDeletingScope;


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
                TextInput::make('title')
                    ->label(__('Заголовок:'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('Текст:')),
                TextInput::make('price')
                    ->label(__('Цена:'))
                    ->required()
                    ->numeric(),
                Toggle::make('is_published')
                    ->label(__('Опубликовать')),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('title')
                ->searchable()
                ->sortable()
                ->label('Заголовок'),
            TextColumn::make('description')
                ->searchable()
                ->sortable()
                ->limit(25)
                ->label('Содержимое'),
            TextColumn::make('price')
                ->searchable()
                ->sortable()
                ->money('RUB')
                ->label('Цена'),
            TextColumn::make('created_at')
                ->searchable()
                ->sortable()
                ->dateTime('d-m-Y H:i')
                ->label('Дата создания'),
            ToggleColumn::make('is_published')
                ->searchable()
                ->sortable()
                ->label('Опубликованно'),
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
