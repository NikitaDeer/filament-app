<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tariff;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TariffResource\Pages;

class TariffResource extends Resource
{
    protected static ?string $model = Tariff::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationGroup = 'Управление подписками и тарифами';

    protected static ?string $navigationLabel = 'Предоставляемые тарифы';

    public static function getModelLabel(): string
    {
        return 'Тариф';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Тарифы';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Предоставляемый тариф')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Название')
                            ->required()
                            ->maxLength(120),

                        Forms\Components\Select::make('type')
                            ->label('Тип')
                            ->options([
                                'trial' => 'Пробный (trial)',
                                'regular' => 'Обычный (regular)'
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('duration_days')
                            ->label('Длительность (дни)')
                            ->numeric()
                            ->minValue(1)
                            ->required(),

                        Forms\Components\TextInput::make('price')
                            ->label('Цена, ₽')
                            ->numeric()
                            ->minValue(0)
                            ->step(1)
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label('Описание')
                            ->rows(3)
                            ->maxLength(1000),

                        Forms\Components\Toggle::make('is_renewable')
                            ->label('Продлеваемый')
                            ->helperText('Разрешить продление тарифа'),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Опубликован')
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->title)
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Тип')
                    ->enum([
                        'trial' => 'Пробный',
                        'regular' => 'Обычный',
                    ])
                    ->colors([
                        'warning' => 'trial',
                        'success' => 'regular',
                    ]),

                Tables\Columns\TextColumn::make('duration_days')
                    ->label('Длительность')
                    ->suffix(' дн.'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 0, '.', ' ') . ' ₽')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Опубликован')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Тип')
                    ->options([
                        'trial' => 'Пробный',
                        'regular' => 'Обычный',
                    ]),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Опубликован')
                    ->placeholder('Все')
                    ->trueLabel('Опубликованные')
                    ->falseLabel('Скрытые')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Редактировать тариф'),
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
            'index' => Pages\ListTariffs::route('/'),
            'create' => Pages\CreateTariff::route('/create'),
            'edit' => Pages\EditTariff::route('/{record}/edit'),
        ];
    }
}
