<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Service;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ServiceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ServiceResource\RelationManagers;

class ServiceResource extends Resource
{
  // protected static ?string $model = Service::class;

  // protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

  // protected static ?string $navigationGroup = 'Управление заявками';

  // protected static ?string $navigationLabel = 'Предоставляемые услуги';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Card::make()
          ->schema([
            Forms\Components\TextInput::make('name')
              ->required(),
            Forms\Components\Textarea::make('description')
              ->required(),
            Forms\Components\Textarea::make('price')
              ->required(),
            Toggle::make('is_published')->label(__('Опубликовать')),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->limit(10)
          ->sortable()
          ->label('Наименование')
          ->searchable(),
        Tables\Columns\TextColumn::make('price')
          ->label('Цена')
          ->sortable(),
        Tables\Columns\TextColumn::make('description')
          ->label('Описание')
          ->sortable()
          ->limit(20),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime('d-m-Y H:i')
          ->label('Дата создания'),
        Tables\Columns\ToggleColumn::make('is_published')
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
      'index' => Pages\ListServices::route('/'),
      'create' => Pages\CreateService::route('/create'),
      'edit' => Pages\EditService::route('/{record}/edit'),
    ];
  }
}
