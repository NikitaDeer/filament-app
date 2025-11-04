<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Транспорт';

    protected static ?string $modelLabel = 'Транспорт';

    protected static ?string $pluralModelLabel = 'Транспорт';

    protected static ?string $navigationGroup = 'Калькулятор';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Название транспорта')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Описание')
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Фотография транспорта')
                            ->image()
                            ->directory('vehicles')
                            ->maxSize(5120)
                            ->nullable()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->columnSpanFull()
                            ->helperText('Максимальный размер: 5 МБ. Рекомендуемое соотношение сторон: 16:9. Необязательно.'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Характеристики')
                    ->schema([
                        Forms\Components\TextInput::make('capacity_tons')
                            ->label('Грузоподъемность (тонн)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01),

                        Forms\Components\TextInput::make('length_m')
                            ->label('Длина (м)')
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01),

                        Forms\Components\TextInput::make('width_m')
                            ->label('Ширина (м)')
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01),

                        Forms\Components\TextInput::make('height_m')
                            ->label('Высота (м)')
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Ценообразование')
                    ->schema([
                        Forms\Components\TextInput::make('price_per_km')
                            ->label('Цена за км (₽)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01)
                            ->prefix('₽'),

                        Forms\Components\TextInput::make('price_per_hour')
                            ->label('Цена за час (₽)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01)
                            ->prefix('₽'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Пассажиры')
                    ->schema([
                        Forms\Components\Toggle::make('allows_passengers')
                            ->label('Можно брать пассажиров')
                            ->default(false)
                            ->reactive(),

                        Forms\Components\TextInput::make('max_passengers')
                            ->label('Максимум пассажиров')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->visible(fn (callable $get) => $get('allows_passengers')),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Настройки')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Порядок сортировки')
                            ->numeric()
                            ->default(0)
                            ->helperText('Чем меньше число, тем выше в списке'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Фото')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('capacity_tons')
                    ->label('Грузоподъемность')
                    ->suffix(' т')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_km')
                    ->label('Цена/км')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, '.', ' ') . ' ₽')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_hour')
                    ->label('Цена/час')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, '.', ' ') . ' ₽')
                    ->sortable(),

                Tables\Columns\IconColumn::make('allows_passengers')
                    ->label('Пассажиры')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активные')
                    ->placeholder('Все')
                    ->trueLabel('Только активные')
                    ->falseLabel('Только неактивные'),

                Tables\Filters\TernaryFilter::make('allows_passengers')
                    ->label('С пассажирами')
                    ->placeholder('Все')
                    ->trueLabel('Принимают пассажиров')
                    ->falseLabel('Без пассажиров'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
