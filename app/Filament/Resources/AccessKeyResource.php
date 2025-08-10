<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccessKeyResource\Pages;
use App\Filament\Resources\AccessKeyResource\RelationManagers;
use App\Models\AccessKey;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccessKeyResource extends Resource
{
    protected static ?string $model = AccessKey::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';
    public static function getModelLabel(): string { return 'Ключ доступа'; }
    public static function getPluralModelLabel(): string { return 'Ключи доступа'; }

    protected static ?string $navigationGroup = 'Управление подписками и тарифами';

    protected static ?string $navigationLabel = 'Ключи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'email')
                    ->required(),
                Forms\Components\Select::make('subscription_id')
                    ->relationship('subscription', 'id')
                    ->required(),
                Forms\Components\Textarea::make('encrypted_key')
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('expires_at')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subscription.tariff.title'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->query(fn (Builder $query): Builder => $query->where('is_active', true))
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
            'index' => Pages\ListAccessKeys::route('/'),
            'create' => Pages\CreateAccessKey::route('/create'),
            'edit' => Pages\EditAccessKey::route('/{record}/edit'),
        ];
    }
}
