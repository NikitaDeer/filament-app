<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationChannelResource\Pages;
use App\Filament\Resources\NotificationChannelResource\RelationManagers;
use App\Models\NotificationChannel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationChannelResource extends Resource
{
    protected static ?string $model = NotificationChannel::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Канал уведомлений')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Название')
                            ->required()
                            ->maxLength(100)
                            ->helperText('Короткое понятное имя канала'),

                        Forms\Components\Select::make('type')
                            ->label('Тип канала')
                            ->options([
                                'email' => 'Email',
                                'phone' => 'Номер телефона',
                                'telegram' => 'Telegram ID',
                            ])
                            ->required()
                            ->reactive(),

                        Forms\Components\TextInput::make('value')
                            ->label('Значение')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Email адрес, номер телефона или Telegram ID')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                // Ничего, триггер для реактивности
                            })
                            ->rule(function (\Closure $fail) use (&$get) {
                                // Фоллбэк, будет заменен в ->validationAttribute ниже
                            })
                            ->placeholder(function (callable $get) {
                                return match ($get('type')) {
                                    'email' => 'example@domain.com',
                                    'phone' => '+79991234567',
                                    'telegram' => '123456789',
                                    default => '',
                                };
                            })
                            ->validationAttribute('значение'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),

                        Forms\Components\Toggle::make('is_default')
                            ->label('По умолчанию')
                            ->helperText('Может быть только один канал по умолчанию')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->name)
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Тип')
                    ->enum([
                        'email' => 'Email',
                        'telegram' => 'Telegram',
                        'whatsapp' => 'WhatsApp',
                    ])
                    ->colors([
                        'primary' => 'email',
                        'success' => 'telegram',
                        'warning' => 'whatsapp',
                    ]),
                Tables\Columns\TextColumn::make('value')
                    ->label('Значение')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->type === 'email') return $state;
                        // для телефонов/чатов частично маскируем
                        $str = (string) $state;
                        return mb_strlen($str) > 6 ? mb_substr($str, 0, 3) . '***' . mb_substr($str, -3) : $str;
                    })
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->value)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_default')
                    ->label('По умолчанию')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Тип')
                    ->options([
                        'email' => 'Email',
                        'phone' => 'Номер телефона',
                        'telegram' => 'Telegram ID',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность')
                    ->placeholder('Все')
                    ->trueLabel('Активные')
                    ->falseLabel('Неактивные')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Редактировать канал'),
                Tables\Actions\Action::make('make_default')
                    ->label('Сделать по умолчанию')
                    ->visible(fn ($record) => !$record->is_default)
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        \App\Models\NotificationChannel::query()->update(['is_default' => false]);
                        $record->update(['is_default' => true, 'is_active' => true]);
                        // Выключаем активность у других каналов того же типа
                        \App\Models\NotificationChannel::where('id', '!=', $record->id)
                            ->where('type', $record->type)
                            ->update(['is_active' => false]);
                    }),
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
            'index' => Pages\ListNotificationChannels::route('/'),
            'create' => Pages\CreateNotificationChannel::route('/create'),
            'edit' => Pages\EditNotificationChannel::route('/{record}/edit'),
        ];
    }
}
