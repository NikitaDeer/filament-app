<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricesContentResource\Pages;
use App\Models\PricesContent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PricesContentResource extends Resource
{
    protected static ?string $model = PricesContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Цены';
    protected static ?string $modelLabel = 'версия';
    protected static ?string $pluralModelLabel = 'версии Цен';
    protected static ?string $navigationGroup = 'Контент сайта';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero-секция')->schema([
                Forms\Components\TextInput::make('hero_badge')->label('Badge')->placeholder('Прозрачное ценообразование'),
                Forms\Components\TextInput::make('hero_title')->label('Заголовок')->required(),
                Forms\Components\Textarea::make('hero_subtitle')->label('Подзаголовок')->required()->rows(2),
            ])->columns(1)->collapsible(),
            
            Forms\Components\Section::make('Секции с ценами')->schema([
                Forms\Components\TextInput::make('transport_section_title')->label('Заголовок "Транспорт"')->columnSpan(2),
                Forms\Components\Textarea::make('transport_section_subtitle')->label('Подзаголовок')->rows(2)->columnSpan(2),
                
                Forms\Components\TextInput::make('options_section_title')->label('Заголовок "Опции"')->columnSpan(2),
                Forms\Components\Textarea::make('options_section_subtitle')->label('Подзаголовок')->rows(2)->columnSpan(2),
                
                Forms\Components\TextInput::make('special_section_title')->label('Заголовок "Особые услуги"')->columnSpan(2),
                Forms\Components\Textarea::make('special_section_subtitle')->label('Подзаголовок')->rows(2)->columnSpan(2),
                
                Forms\Components\TextInput::make('conditions_section_title')->label('Заголовок "Условия"')->columnSpan(2),
                Forms\Components\Textarea::make('conditions_section_description')->label('Описание')->rows(3)->columnSpan(2),
                
                Forms\Components\Repeater::make('conditions_items')
                    ->label('Карточки условий')
                    ->schema([
                        Forms\Components\Select::make('icon')
                            ->label('Иконка')
                            ->options([
                                'heroicon-o-truck' => 'Грузовик',
                                'heroicon-o-clock' => 'Часы',
                                'heroicon-o-currency-dollar' => 'Деньги',
                                'heroicon-o-users' => 'Люди',
                                'heroicon-o-archive' => 'Коробка',
                                'heroicon-o-clipboard-check' => 'Список',
                                'heroicon-o-shield-check' => 'Щит',
                                'heroicon-o-star' => 'Звезда',
                                'heroicon-o-lightning-bolt' => 'Молния',
                                'heroicon-o-office-building' => 'Здание',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('title')->label('Заголовок')->required(),
                        Forms\Components\Textarea::make('description')->label('Описание')->required(),
                    ])
                    ->columns(3)
                    ->columnSpan(2),
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
            'index' => Pages\ListPricesContents::route('/'),
            'create' => Pages\CreatePricesContent::route('/create'),
            'edit' => Pages\EditPricesContent::route('/{record}/edit'),
        ];
    }    
}
