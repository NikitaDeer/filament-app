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
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Название')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->label('Тип канала')
                            ->options([
                                'email' => 'Email',
                                'telegram' => 'Telegram',
                                'whatsapp' => 'WhatsApp',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('value')
                            ->label('Значение')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Email адрес, номер телефона или ID чата'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),
                        Forms\Components\Toggle::make('is_default')
                            ->label('По умолчанию')
                            ->default(false)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $livewire) {
                                if ($state) {
                                    // Если установлен как канал по умолчанию, сбросить все другие
                                    $livewire->notify('info', 'Другие каналы по умолчанию будут сброшены');
                                }
                            }),
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
            'index' => Pages\ListNotificationChannels::route('/'),
            'create' => Pages\CreateNotificationChannel::route('/create'),
            'edit' => Pages\EditNotificationChannel::route('/{record}/edit'),
        ];
    }    
}
