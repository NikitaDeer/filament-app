<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
  protected static ?string $model = User::class;

  protected static ?string $navigationIcon = 'heroicon-o-users';
  protected static ?string $navigationGroup = 'Управление пользователями';

  protected static ?string $navigationLabel = 'Пользователи';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Card::make()
          ->schema([
            TextInput::make('name')
              ->required()
              ->maxLength(255)
              ->label('Имя'),
            TextInput::make('email')
              ->email()
              ->required()
              ->unique(ignoreRecord: true)
              ->label('Email'),
            TextInput::make('password')
              ->password()
              ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser)
              ->minLength(8)
              ->label('Пароль')
              ->dehydrateStateUsing(fn ($state) => Hash::make($state))
              ->visible(fn ($livewire) => $livewire instanceof Pages\CreateUser),
            TextInput::make('email_verified_at')
              ->disabled()
              ->label('Дата подтверждения email')
              ->formatStateUsing(fn ($state) => $state ? date('d.m.Y H:i', strtotime($state)) : 'Не подтвержден')
              ->visible(fn ($livewire) => !($livewire instanceof Pages\CreateUser)),
            Forms\Components\Select::make('current_tariff_id')
              ->relationship('currentTariff', 'title')
              ->label('Текущий тариф')
              ->visible(fn ($livewire) => !($livewire instanceof Pages\CreateUser)),
            Forms\Components\Select::make('tariff_status')
              ->options([
                'active' => 'Активен',
                'non-active' => 'Не активен',
                'paused' => 'Приостановлен'
              ])
              ->label('Статус тарифа')
              ->visible(fn ($livewire) => !($livewire instanceof Pages\CreateUser)),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->searchable()
          ->sortable()
          ->label('Имя'),
        TextColumn::make('email')
          ->searchable()
          ->sortable()
          ->label('Email'),
        TextColumn::make('currentTariff.title')
          ->label('Текущий тариф')
          ->default('Нет тарифа'),
        TextColumn::make('orders')
          ->label('Срок тарифа')
          ->formatStateUsing(function ($record) {
            $activeOrder = $record->orders()
              ->where('order_status', 'active')
              ->latest()
              ->first();
            
            if (!$activeOrder) {
              return 'Нет активного тарифа';
            }

            return match ($activeOrder->duration) {
              '1_month' => '1 месяц',
              '3_months' => '3 месяца',
              '12_months' => '12 месяцев',
              default => 'Не указан'
            };
          }),
        BadgeColumn::make('tariff_status')
          ->label('Статус тарифа')
          ->enum([
            'active' => 'Активен',
            'non-active' => 'Не активен',
            'paused' => 'Приостановлен'
          ])
          ->colors([
            'success' => 'active',
            'danger' => 'non-active',
            'warning' => 'paused',
          ]),
        TextColumn::make('roles.name')
          ->label('Роль')
          ->formatStateUsing(fn (string $state): string => match ($state) {
            'Admin' => 'Администратор',
            'User' => 'Пользователь',
            default => $state
          }),
        TextColumn::make('created_at')
          ->dateTime('d.m.Y H:i')
          ->label('Дата регистрации'),
      ])
      ->filters([
        Tables\Filters\SelectFilter::make('tariff_status')
          ->options([
            'active' => 'Активен',
            'non-active' => 'Не активен',
            'paused' => 'Приостановлен'
          ])
          ->label('Статус тарифа')
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
      'index' => Pages\ListUsers::route('/'),
      'create' => Pages\CreateUser::route('/create'),
      'edit' => Pages\EditUser::route('/{record}/edit'),
    ];
  }
}
