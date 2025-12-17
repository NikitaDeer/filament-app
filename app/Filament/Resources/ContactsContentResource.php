<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactsContentResource\Pages;
use App\Models\ContactsContent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ContactsContentResource extends Resource
{
    protected static ?string $model = ContactsContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationLabel = 'Контакты';
    protected static ?string $modelLabel = 'версия';
    protected static ?string $pluralModelLabel = 'версии Контактов';
    protected static ?string $navigationGroup = 'Контент сайта';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero-секция')->schema([
                Forms\Components\TextInput::make('hero_title')->label('Заголовок')->required(),
                Forms\Components\Textarea::make('hero_subtitle')->label('Подзаголовок')->required()->rows(2),
            ])->columns(1)->collapsible(),
            
            Forms\Components\Section::make('Поддержка')->schema([
                Forms\Components\TextInput::make('support_title')->label('Заголовок')->placeholder('Поддержка'),
                Forms\Components\TextInput::make('support_phone')->label('Телефон')->placeholder('+7 (812) 123-45-67'),
                Forms\Components\TextInput::make('support_email')->label('Email')->placeholder('support@example.com'),
            ])->columns(1)->collapsible(),
            
            Forms\Components\Section::make('Часы работы')->schema([
                Forms\Components\TextInput::make('hours_title')->label('Заголовок')->placeholder('Режим работы'),
                Forms\Components\TextInput::make('hours_weekdays')->label('Будни')->placeholder('Пн-Пт: 9:00-21:00'),
                Forms\Components\TextInput::make('hours_weekend')->label('Выходные')->placeholder('Сб-Вс: 10:00-18:00'),
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
            'index' => Pages\ListContactsContents::route('/'),
            'create' => Pages\CreateContactsContent::route('/create'),
            'edit' => Pages\EditContactsContent::route('/{record}/edit'),
        ];
    }    
}
