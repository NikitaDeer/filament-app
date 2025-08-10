<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Filament\Resources\SubscriptionResource\RelationManagers;
use App\Models\Subscription;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Управление подписками и тарифами';

    protected static ?string $navigationLabel = 'Подписки';

    public static function getModelLabel(): string { return 'Подписка'; }
    public static function getPluralModelLabel(): string { return 'Подписки'; }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'email')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('tariff_id')
                    ->relationship('tariff', 'title')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'expired' => 'Expired',
                        'pending' => 'Pending'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('final_price')
                    ->numeric()
                    ->prefix('RUB')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email')
                    ->searchable()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('tariff.title')
                ->label('Название тарифа'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'expired',
                        'warning' => 'pending',
                    ])
                    ->sortable()
                    ->label('Статус подписки'),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата окончания подписки'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'expired' => 'Expired',
                        'pending' => 'Pending'
                    ])
                    ->label('Статус подписки'),
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
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}
