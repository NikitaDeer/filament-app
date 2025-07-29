<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceCategoryResource\Pages;
use App\Models\PriceCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PriceCategoryResource extends Resource
{
  protected static ?string $model = PriceCategory::class;

  protected static ?string $navigationIcon = 'heroicon-o-tag';

  protected static ?string $navigationLabel = 'Категории цен';

  protected static ?string $pluralModelLabel = 'Категории цен';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->label('Название')
          ->required()
          ->maxLength(255),
        Forms\Components\Textarea::make('description')
          ->label('Описание')
          ->maxLength(65535)
          ->columnSpanFull(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Название'),
        Tables\Columns\TextColumn::make('created_at')
          ->label('Дата создания')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
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
      'index' => Pages\ListPriceCategories::route('/'),
      'create' => Pages\CreatePriceCategory::route('/create'),
      'edit' => Pages\EditPriceCategory::route('/{record}/edit'),
    ];
  }
}