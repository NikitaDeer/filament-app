<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicesContentResource\Pages;
use App\Models\ServicesContent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ServicesContentResource extends Resource
{
    protected static ?string $model = ServicesContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Услуги';
    protected static ?string $modelLabel = 'версия';
    protected static ?string $pluralModelLabel = 'версии Услуг';
    protected static ?string $navigationGroup = 'Контент сайта';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero-секция')->schema([
                Forms\Components\TextInput::make('hero_badge')->label('Badge')->placeholder('Наши услуги'),
                Forms\Components\TextInput::make('hero_title')->label('Заголовок')->required()->columnSpan(2),
                Forms\Components\Textarea::make('hero_subtitle')->label('Подзаголовок')->required()->rows(3)->columnSpan(2),
            ])->columns(2)->collapsible(),
            
            Forms\Components\Section::make('Секция "Доступны в калькуляторе"')->schema([
                Forms\Components\TextInput::make('calculator_section_title')->label('Заголовок'),
                Forms\Components\Textarea::make('calculator_section_subtitle')->label('Подзаголовок')->rows(2),
            ])->columns(2)->collapsible(),
            
            Forms\Components\Section::make('Секция "Дополнительные услуги"')->schema([
                Forms\Components\TextInput::make('other_section_title')->label('Заголовок'),
                Forms\Components\Textarea::make('other_section_subtitle')->label('Подзаголовок')->rows(2),
            ])->columns(2)->collapsible(),
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
            'index' => Pages\ListServicesContents::route('/'),
            'create' => Pages\CreateServicesContent::route('/create'),
            'edit' => Pages\EditServicesContent::route('/{record}/edit'),
        ];
    }    
}
