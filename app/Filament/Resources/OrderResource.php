<?php

namespace App\Filament\Resources;


use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
  protected static ?string $model = Order::class;

  protected static ?string $navigationIcon = 'heroicon-o-collection';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')->label('Имя клиента')->disabled(),
        Forms\Components\TextInput::make('phone')->label('Телефон')->disabled(),
        Forms\Components\TextInput::make('email')->label('Email')->disabled(),
        Forms\Components\TextInput::make('from_address')->label('Начальная точка')->disabled(),
        Forms\Components\TextInput::make('to_address')->label('Конечная точка')->disabled(),
        Forms\Components\TextInput::make('distance')->label('Километраж')->disabled(),
        Forms\Components\TextInput::make('cost')->label('Стоимость')->disabled(),
        Forms\Components\Textarea::make('comment')->label('Комментарий')->disabled(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')->label('Имя клиента')->searchable(),
        Tables\Columns\TextColumn::make('phone')->label('Телефон')->searchable(),
        Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
        Tables\Columns\TextColumn::make('from_address')->label('Начальная точка'),
        Tables\Columns\TextColumn::make('to_address')->label('Конечная точка'),
        Tables\Columns\TextColumn::make('distance')->label('Километраж')->sortable(),
        Tables\Columns\TextColumn::make('cost')->label('Стоимость')->sortable(),
        Tables\Columns\TextColumn::make('comment')->label('Комментарий')->limit(50),
        Tables\Columns\TextColumn::make('created_at')->label('Дата заказа')->dateTime('d-m-Y H:i'),
      ])
      ->filters([
        //
      ])
      ->actions([
        // Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        // Tables\Actions\DeleteBulkAction::make(),
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
      'edit' => Pages\EditOrder::route('/{record}/edit'),
    ];
  }
}
