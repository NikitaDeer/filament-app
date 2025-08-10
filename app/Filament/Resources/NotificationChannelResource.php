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
                                'telegram' => 'Telegram',
                                'whatsapp' => 'WhatsApp',
                            ])
                            ->required()
                            ->reactive(),

                        Forms\Components\TextInput::make('value')
                            ->label('Значение')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Email адрес, номер телефона или ID чата')
                            ->rule(function (callable $get) {
                                return match ($get('type')) {
                                    'email' => ['email'],
                                    default => ['string'],
                                };
                            }),

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
                        'telegram' => 'Telegram',
                        'whatsapp' => 'WhatsApp',
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
