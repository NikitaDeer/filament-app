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
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\NumberColumn;
use Filament\Tables\Columns\IconColumn;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
  protected static ?string $model = User::class;

  protected static ?string $navigationIcon = 'heroicon-o-users';
  protected static ?string $navigationGroup = 'Управление пользователями системы';

  protected static ?string $navigationLabel = 'Пользователи';

  public static function getModelLabel(): string { return 'Пользователь'; }
  public static function getPluralModelLabel(): string { return 'Пользователи'; }



  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Card::make()
          ->schema([
            Forms\Components\TextInput::make('name'),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
            Forms\Components\TextInput::make('password')
                ->password()
                ->required()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->hiddenOn('edit'),
            Forms\Components\Select::make('current_tariff_id')
                ->relationship('currentTariff', 'title'),
            Forms\Components\Select::make('tariff_status')
                ->options([
                    'active' => 'Active',
                    'expired' => 'Expired',
                    'paused' => 'Paused'
                ]),

            // Добавляем поле для выбора ролей
            Forms\Components\Select::make('roles')
                ->label('Роли')
                ->multiple()
                ->relationship('roles', 'name')
                ->options(function () {
                    return Role::all()->pluck('name', 'id')->toArray();
                })
                ->preload()
                ->searchable()
                ->helperText('Выберите роли для пользователя'),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('email')
        ->searchable(),

        // Добавляем колонку с ролями
        Tables\Columns\BadgeColumn::make('roles')
        ->label('Роли')
        ->getStateUsing(function ($record) {
            return $record->roles->pluck('name')->toArray();
        })
        ->colors([
            'danger' => 'Admin',
            'primary' => 'User',
        ]),

        Tables\Columns\TextColumn::make('currentTariff.title')
        ->label('Текущий тариф'),

        // Заменяем колонку tariff_status на динамическую колонку, основанную на реальном статусе подписки
        Tables\Columns\BadgeColumn::make('subscription_status')
        ->label('Статус подписки')
        ->getStateUsing(function ($record) {
            $subscriptionStatus = $record->getSubscriptionStatus();


            return $subscriptionStatus['status'];
        })
        ->colors([
            'success' => 'active',
            'warning' => 'trial',
            'danger' => 'inactive'
        ])
        ->formatStateUsing(function ($state) {
            return match($state) {
                'active' => 'Активна',
                'trial' => 'Пробный период',
                'inactive' => 'Не активна',
                default => 'Неизвестно'
            };
        }),

        // Добавляем колонку с датой окончания
        Tables\Columns\TextColumn::make('subscription_end_date')
        ->label('Окончание подписки')
        ->getStateUsing(function ($record) {
            $subscriptionStatus = $record->getSubscriptionStatus();
            if (isset($subscriptionStatus['end_date'])) {
                return $subscriptionStatus['end_date']->format('d.m.Y H:i');
            }
            return '-';
        }),
      ])
      ->filters([
        Tables\Filters\SelectFilter::make('subscription_status')
          ->options([
            'active' => 'Активна',
            'trial' => 'Пробный период',
            'inactive' => 'Не активна'
          ])
          ->label('Статус подписки')
          ->query(function (Builder $query, array $data): Builder {
            if (!$data['value']) {
                return $query;
            }

            return $query->where(function ($query) use ($data) {
                switch ($data['value']) {
                    case 'active':
                        $query->whereHas('subscriptions', function ($q) {
                            $q->where('status', 'active')
                              ->where('end_date', '>', now());
                        });
                        break;
                    case 'trial':
                        $query->where('trial_ends_at', '>', now());
                        break;
                    case 'inactive':
                        $query->whereDoesntHave('subscriptions', function ($q) {
                            $q->where('status', 'active')
                              ->where('end_date', '>', now());
                        })
                        ->where(function ($q) {
                            $q->whereNull('trial_ends_at')
                              ->orWhere('trial_ends_at', '<=', now());
                        });
                        break;
                }
            });
          }),

        // Добавляем фильтр по ролям
        Tables\Filters\SelectFilter::make('roles')
          ->label('Роль')
          ->relationship('roles', 'name')
          ->options(function () {
              return Role::all()->pluck('name', 'name')->toArray();
          }),
      ])
      ->actions([
        Tables\Actions\EditAction::make(),

        // Добавляем быстрое действие для смены роли
        Tables\Actions\Action::make('change_role')
            ->label('Изменить роль')
            ->icon('heroicon-o-shield-check')
            ->form([
                Select::make('role')
                    ->label('Роль')
                    ->options(function () {
                        return Role::all()->pluck('name', 'name')->toArray();
                    })
                    ->required()
                    ->default(function ($record) {
                        return $record->roles->first()?->name;
                    }),
            ])
            ->action(function (array $data, $record): void {
                $record->syncRoles([$data['role']]);
            })
            ->requiresConfirmation()
            ->modalHeading('Изменить роль пользователя')
            ->modalSubheading('Вы уверены, что хотите изменить роль этого пользователя?'),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),

        // Добавляем массовое действие для назначения роли
        Tables\Actions\BulkAction::make('assign_role')
            ->label('Назначить роль')
            ->icon('heroicon-o-shield-check')
            ->form([
                Select::make('role')
                    ->label('Роль')
                    ->options(function () {
                        return Role::all()->pluck('name', 'name')->toArray();
                    })
                    ->required(),
            ])
            ->action(function (array $data, $records): void {
                foreach ($records as $record) {
                    $record->syncRoles([$data['role']]);
                }
            })
            ->requiresConfirmation()
            ->modalHeading('Назначить роль выбранным пользователям')
            ->modalSubheading('Вы уверены, что хотите назначить роль выбранным пользователям?'),
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
