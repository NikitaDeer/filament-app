<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
  protected static ?string $model = Order::class;

  protected static ?string $navigationIcon = 'heroicon-o-user-group';

  protected static ?string $navigationGroup = 'Управление услугами и заявками';

  protected static ?string $navigationLabel = 'Заявки клиентов';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Card::make()
          ->schema([
            Forms\Components\Select::make('tariff_id')
              ->relationship('tariff', 'title')
              ->required()
              ->label('Выберите тариф')
              ->options(
                \App\Models\Tariff::where('is_published', 1)->pluck('name', 'id')->toArray()
              ),
            // ->getOptions(function () {
            //   return \App\Models\Service::where('is_published', 1)->get()->pluck('name', 'id')->toArray();
            // }),
            Forms\Components\Select::make('user_id')
              ->relationship('user', 'email')
              ->required()
              ->label('Имя пользователя'),
            Forms\Components\Select::make('order_status')
              ->options([
                  'active' => 'Активный',
                  'non-active' => 'Неактивный',
                  'paused' => 'Приостановлен'
              ])
              ->default('non-active')
              ->label('Статус'),
          ])->columns(3),

        Card::make()
          ->schema([
            Forms\Components\Textarea::make('description')
              ->maxLength(1000)
              ->label('Описание'),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('id')
          ->sortable()
          ->label('ID')
          ->searchable(),
        Tables\Columns\TextColumn::make('user.email')
          ->sortable()
          ->label('Имя пользователя')
          ->searchable(),
        Tables\Columns\TextColumn::make('tariff.title')
          ->sortable()
          ->label('Тариф')
          ->searchable(),
        Tables\Columns\TextColumn::make('tariff.price')
          ->sortable()
          ->label('Цена')
          ->searchable(),
        Tables\Columns\BadgeColumn::make('order_status')
          ->colors([
              'success' => 'active',
              'danger' => 'non-active',
              'warning' => 'paused',
          ]),
        Tables\Columns\TextColumn::make('description')
          ->limit(20)
          ->label('Описание')
          ->searchable(),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->label('Создан'),
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
      'index' => Pages\ListOrders::route('/'),
      'create' => Pages\CreateOrder::route('/create'),
      'edit' => Pages\EditOrder::route('/{record}/edit'),
    ];
  }
}