<?php

namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms;
use App\Models\Service;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Filament\Resources\ServiceResource\Pages;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Наши услуги')
                    ->schema([
                        TextInput::make('name')
                            ->label('Название услуги')
                            ->required()
                            ->columnSpan(2),

                        Textarea::make('description')
                            ->label('Описание услуги')
                            ->required()
                            ->columnSpan(2),

                        Toggle::make('is_published')
                            ->label('Опубликована')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название услуги')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Описание')
                    ->limit(50),

                Tables\Columns\BooleanColumn::make('is_published')
                    ->label('Опубликована'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('name')
                    ->label('Название')
                    ->searchable()
                    ->options(Service::all()->pluck('name', 'id')),

                Tables\Filters\SelectFilter::make('is_published')
                    ->label('Статус')
                    ->options([
                        'Да' => true,
                        'Нет' => false,
                    ]),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}