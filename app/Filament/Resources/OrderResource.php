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
  protected static ?string $navigationGroup = 'Полученные заявки от клиентов';
  protected static ?string $navigationLabel = 'Заявки';

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
        Tables\Columns\TextColumn::make('name')
          ->label('Имя клиента')
          ->searchable()
          ->limit(20)
          ->tooltip(fn ($record) => $record->name),

        Tables\Columns\TextColumn::make('phone')
          ->label('Телефон')
          ->searchable()
          ->formatStateUsing(function ($state) {
              $digits = preg_replace('/[^0-9]/', '', (string) $state);
              if (strlen($digits) === 11) {
                  $digits = ($digits[0] === '8') ? ('7' . substr($digits, 1)) : $digits;
                  if ($digits[0] === '7') {
                      return '+7 (' . substr($digits, 1, 3) . ') ' . substr($digits, 4, 3) . '-' . substr($digits, 7, 2) . '-' . substr($digits, 9, 2);
                  }
              }
              if (strlen($digits) === 10) {
                  return '+7 (' . substr($digits, 0, 3) . ') ' . substr($digits, 3, 3) . '-' . substr($digits, 6, 2) . '-' . substr($digits, 8, 2);
              }
              return (string) $state;
          }),

        Tables\Columns\TextColumn::make('email')
          ->label('Email')
          ->searchable()
          ->limit(25)
          ->tooltip(fn ($record) => $record->email),

        Tables\Columns\TextColumn::make('from_address')
          ->label('Начальная точка')
          ->limit(30)
          ->tooltip(fn ($record) => $record->from_address),

        Tables\Columns\TextColumn::make('to_address')
          ->label('Конечная точка')
          ->limit(30)
          ->tooltip(fn ($record) => $record->to_address),

        Tables\Columns\TextColumn::make('distance')
          ->label('Километраж')
          ->suffix(' км')
          ->sortable(),

        Tables\Columns\TextColumn::make('cost')
          ->label('Стоимость')
          ->suffix(' ₽')
          ->sortable(),

        Tables\Columns\TextColumn::make('comment')
          ->label('Комментарий')
          ->limit(50)
          ->tooltip(fn ($record) => $record->comment),
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
