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
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;

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
            Forms\Components\TextInput::make('name')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('password')
                ->password()
                ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                ->minLength(8)
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state)),
            Forms\Components\Select::make('roles')
                ->multiple()
                ->relationship('roles', 'name')
                ->preload()
                // При создании пользователя по умолчанию будет выбрана роль Admin
                ->default(fn (Page $livewire): array => $livewire instanceof CreateRecord ? [Role::where('name', 'Admin')->first()?->id] : [])
                ->disabled(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                ->helperText(fn (Page $livewire): string => $livewire instanceof CreateRecord ? 'Пользователь будет создан с ролью Admin.' : '')
                // Запрещаем администратору редактировать собственные роли
                ->visible(fn ($record) => !$record || $record->id !== auth()->id()),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
        Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
        Tables\Columns\BadgeColumn::make('roles.name')
            ->label('Роли')
            ->sortable()
            ->colors([
                'danger' => 'Admin',
            ]),
        Tables\Columns\TextColumn::make('created_at')
            ->label('Дата создания')
            ->dateTime('d.m.Y H:i')
            ->sortable(),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make()
            ->visible(fn (User $record): bool => !$record->hasRole('Admin') && $record->id !== auth()->id()),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make()
            ->action(function (Collection $records) {
                $currentUser = auth()->user();
                $deletedCount = 0;
                $notDeletedCount = 0;

                $records->each(function (User $record) use ($currentUser, &$deletedCount, &$notDeletedCount) {
                    if ($record->id === $currentUser->id || $record->hasRole('Admin')) {
                        $notDeletedCount++;
                    } else {
                        $record->delete();
                        $deletedCount++;
                    }
                });

                if ($deletedCount > 0) {
                    Notification::make()
                        ->title('Пользователи удалены')
                        ->body("Успешно удалено {$deletedCount} пользователей.")
                        ->success()
                        ->send();
                }

                if ($notDeletedCount > 0) {
                    Notification::make()
                        ->title('Некоторые пользователи не были удалены')
                        ->body("Не удалось удалить {$notDeletedCount} пользователей, так как они являются администраторами или это ваш собственный аккаунт.")
                        ->warning()
                        ->send();
                }
            })
            ->deselectRecordsAfterCompletion(),
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
