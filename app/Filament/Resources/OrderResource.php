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
  public static function getModelLabel(): string { return 'Заявка'; }
  public static function getPluralModelLabel(): string { return 'Заявки'; }
  protected static ?string $navigationGroup = 'Полученные заявки от клиентов';
  protected static ?string $navigationLabel = 'Заявки';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Section::make('Информация о клиенте')
          ->schema([
            Forms\Components\TextInput::make('name')->label('Имя клиента')->disabled(),
            Forms\Components\TextInput::make('phone')->label('Телефон')->disabled(),
            Forms\Components\TextInput::make('email')->label('Email')->disabled(),
          ])->columns(3),

        Forms\Components\Section::make('Маршрут')
          ->schema([
            Forms\Components\TextInput::make('from_address')->label('Начальная точка')->disabled()->columnSpanFull(),
            Forms\Components\TextInput::make('to_address')->label('Конечная точка')->disabled()->columnSpanFull(),
            Forms\Components\Repeater::make('route_points')
              ->label('Все точки маршрута')
              ->schema([
                Forms\Components\TextInput::make('address')
                  ->label('Адрес')
                  ->disabled()
                  ->columnSpanFull(),
                Forms\Components\KeyValue::make('details')
                  ->label('Детали (подъезд, этаж и т.д.)')
                  ->disabled(),
              ])
              ->disabled()
              ->columnSpanFull()
              ->visible(fn ($record) => !empty($record->route_points)),
            Forms\Components\TextInput::make('distance')->label('Расстояние (км)')->disabled(),
            Forms\Components\TextInput::make('estimated_hours')->label('Расчетное время (ч)')->disabled(),
          ])->columns(2),

        Forms\Components\Section::make('Транспорт и опции')
          ->schema([
            Forms\Components\Select::make('vehicle_id')
              ->label('Выбранный транспорт')
              ->relationship('vehicle', 'name')
              ->disabled(),
            Forms\Components\TextInput::make('loaders_count')->label('Грузчиков')->disabled(),
            Forms\Components\TextInput::make('passengers_count')->label('Пассажиров')->disabled(),
            Forms\Components\TextInput::make('floors_count')->label('Этажей')->disabled(),
            Forms\Components\Toggle::make('has_cargo_elevator')->label('Грузовой лифт')->disabled(),
          ])->columns(3),

        Forms\Components\Section::make('Стоимость')
          ->schema([
            Forms\Components\TextInput::make('base_distance_cost')->label('За расстояние (₽)')->disabled()->prefix('₽'),
            Forms\Components\TextInput::make('base_time_cost')->label('За время (₽)')->disabled()->prefix('₽'),
            Forms\Components\TextInput::make('services_cost')->label('Услуги (₽)')->disabled()->prefix('₽'),
            Forms\Components\TextInput::make('options_cost')->label('Опции (₽)')->disabled()->prefix('₽'),
            Forms\Components\TextInput::make('total_cost')
              ->label('ИТОГО (₽)')
              ->disabled()
              ->prefix('₽')
              ->extraAttributes(['class' => 'font-bold text-lg']),
          ])->columns(2),

        Forms\Components\Section::make('Дополнительно')
          ->schema([
            Forms\Components\DatePicker::make('scheduled_date')->label('Запланированная дата')->disabled(),
            Forms\Components\TextInput::make('scheduled_time')->label('Запланированное время')->disabled(),
            Forms\Components\Toggle::make('is_cash_payment')->label('Оплата наличными')->disabled(),
            Forms\Components\Textarea::make('client_comments')->label('Комментарии клиента')->disabled()->columnSpanFull(),
            Forms\Components\Textarea::make('comment')->label('Комментарий')->disabled()->columnSpanFull(),
            Forms\Components\TextInput::make('created_at')->label('Дата создания')->disabled(),
          ])->columns(3)->collapsible(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('id')
          ->label('№')
          ->sortable(),

        Tables\Columns\TextColumn::make('name')
          ->label('Клиент')
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

        Tables\Columns\TextColumn::make('vehicle.name')
          ->label('Транспорт')
          ->limit(20)
          ->default('—')
          ->tooltip(fn ($record) => $record->vehicle?->name),

        Tables\Columns\TextColumn::make('from_address')
          ->label('Откуда')
          ->limit(25)
          ->tooltip(fn ($record) => $record->from_address)
          ->toggleable(),

        Tables\Columns\TextColumn::make('to_address')
          ->label('Куда')
          ->limit(25)
          ->tooltip(fn ($record) => $record->to_address)
          ->toggleable(),

        Tables\Columns\TextColumn::make('distance')
          ->label('Км')
          ->suffix(' км')
          ->sortable(),

        Tables\Columns\TextColumn::make('total_cost')
          ->label('Итого')
          ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, '.', ' ') . ' ₽' : '0 ₽')
          ->sortable()
          ->weight('bold')
          ->color('success'),

        Tables\Columns\TextColumn::make('loaders_count')
          ->label('Грузч.')
          ->default('—')
          ->toggleable(isToggledHiddenByDefault: true),

        Tables\Columns\TextColumn::make('passengers_count')
          ->label('Пасс.')
          ->default('—')
          ->toggleable(isToggledHiddenByDefault: true),

        Tables\Columns\TextColumn::make('scheduled_date')
          ->label('Запл. дата')
          ->date('d.m.Y')
          ->default('—')
          ->toggleable(isToggledHiddenByDefault: true),

        Tables\Columns\IconColumn::make('is_cash_payment')
          ->label('Наличные')
          ->boolean()
          ->toggleable(isToggledHiddenByDefault: true),

        Tables\Columns\TextColumn::make('created_at')
          ->label('Дата')
          ->dateTime('d.m.Y H:i')
          ->sortable(),
      ])
      ->filters([
        Tables\Filters\Filter::make('created_at')
          ->form([
            Forms\Components\DatePicker::make('created_from')->label('От'),
            Forms\Components\DatePicker::make('created_until')->label('До'),
          ])
          ->query(function (Builder $query, array $data): Builder {
            return $query
              ->when(
                $data['created_from'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
              )
              ->when(
                $data['created_until'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
              );
          }),

        Tables\Filters\SelectFilter::make('vehicle_id')
          ->label('Транспорт')
          ->relationship('vehicle', 'name'),
      ])
      ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make()
          ->requiresConfirmation()
          ->modalHeading('Удалить заказ?')
          ->modalSubheading('Это действие нельзя отменить'),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
      ])
      ->defaultSort('created_at', 'desc');
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
