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
use Filament\Forms\Components\Select;
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
          ->required()
          ->maxLength(100),

        Section::make('Ценообразование')
          ->schema([
            Select::make('pricing_type')
              ->label('Тип цены')
              ->options([
                'fixed' => 'Фиксированная цена',
                'hourly' => 'Руб/час',
              ])
              ->required()
              ->default('fixed'),

            Forms\Components\TextInput::make('price')
              ->label('Цена')
              ->numeric()
              ->minValue(0)
              ->step(0.1)
              ->required()
              ->helperText('Укажите стоимость в рублях.'),
          ])->columns(2),

        Forms\Components\Textarea::make('description')
          ->label('Краткое описание')
          ->required()
          ->maxLength(1000)
          ->columnSpan('full'),
        Forms\Components\TagsInput::make('features')
          ->label('Особенности услуги')
          ->placeholder('Добавьте особенность и нажмите Enter')
          ->columnSpan('full'),
        Forms\Components\Toggle::make('is_published')
          ->label('Опубликовано')
          ->default(true),
        Forms\Components\Toggle::make('is_popular')
          ->label('Популярная услуга')
          ->default(false),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Название')
          ->searchable()
          ->limit(30)
          ->tooltip(fn ($record) => $record->name),

        Tables\Columns\TextColumn::make('price')
          ->label('Цена')
          ->formatStateUsing(function ($state, $record) {
            if ($record && $record->pricing_type === 'hourly') {
              return number_format((float) $state, 0, '.', ' ') . ' ₽/час';
            }
            return 'от ' . number_format((float) $state, 0, '.', ' ') . ' ₽';
          })
          ->sortable(),

        Tables\Columns\BadgeColumn::make('pricing_type')
          ->label('Тип цены')
          ->colors([
            'success' => 'fixed',
            'warning' => 'hourly',
          ])
          ->formatStateUsing(fn ($state) => $state === 'hourly' ? 'Руб/час' : 'Фикс.'),

        Tables\Columns\IconColumn::make('is_published')->boolean()->label('Опубликовано'),
        Tables\Columns\IconColumn::make('is_popular')->boolean()->label('Популярная'),
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
