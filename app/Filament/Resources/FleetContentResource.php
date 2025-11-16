<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FleetContentResource\Pages;
use App\Models\FleetContent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FleetContentResource extends Resource
{
    protected static ?string $model = FleetContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Автопарк';
    protected static ?string $modelLabel = 'версия';
    protected static ?string $pluralModelLabel = 'версии Автопарка';
    protected static ?string $navigationGroup = 'Контент сайта';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero-секция')->schema([
                Forms\Components\TextInput::make('hero_title')->label('Заголовок')->required(),
                Forms\Components\Textarea::make('hero_subtitle')->label('Подзаголовок')->required()->rows(3),
            ])->columns(1)->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->label('№')->sortable(),
            Tables\Columns\TextColumn::make('hero_title')->label('Заголовок')->limit(50)->searchable(),
            Tables\Columns\ToggleColumn::make('is_published')->label('Опубликовано')->onColor('success')->offColor('gray'),
            Tables\Columns\TextColumn::make('created_at')->label('Создано')->dateTime('d.m.Y H:i')->sortable(),
            Tables\Columns\TextColumn::make('creator.name')->label('Автор')->default('Система'),
        ])->filters([
            Tables\Filters\TernaryFilter::make('is_published')->label('Статус'),
        ])->actions([
            Tables\Actions\EditAction::make()->label('Редактировать'),
            Tables\Actions\DeleteAction::make()->label('Удалить')->requiresConfirmation(),
        ])->defaultSort('id', 'desc');
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFleetContents::route('/'),
            'create' => Pages\CreateFleetContent::route('/create'),
            'edit' => Pages\EditFleetContent::route('/{record}/edit'),
        ];
    }    
}
