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
        Forms\Components\TextInput::make('name')
          ->label('Название услуги')
          ->required(),
        Forms\Components\TextInput::make('price')
          ->label('Цена (например, "от 2,500 ₽" или "от 500 ₽/час")')
          ->required(),
        Forms\Components\Textarea::make('description')
          ->label('Краткое описание')
          ->required()
          ->columnSpan('full'),
        Forms\Components\KeyValue::make('features')
          ->label('Особенности услуги')
          ->keyLabel('ID')
          ->valueLabel('Текст особенности')
          ->addActionLabel('Добавить особенность')
          ->columnSpan('full'),
        Forms\Components\Toggle::make('is_published')
          ->label('Опубликовано')
          ->default(true),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')->label('Название')->searchable(),
        Tables\Columns\TextColumn::make('price')->label('Цена'),
        Tables\Columns\IconColumn::make('is_published')->boolean()->label('Опубликовано'),
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
      'index' => Pages\ListServices::route('/'),
      'create' => Pages\CreateService::route('/create'),
      'edit' => Pages\EditService::route('/{record}/edit'),
    ];
  }
}