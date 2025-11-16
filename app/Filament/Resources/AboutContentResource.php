<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutContentResource\Pages;
use App\Models\AboutContent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AboutContentResource extends Resource
{
    protected static ?string $model = AboutContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationLabel = 'О компании';

    protected static ?string $modelLabel = 'версия';

    protected static ?string $pluralModelLabel = 'версии О компании';

    protected static ?string $navigationGroup = 'Контент сайта';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero-секция')
                    ->description('Главный заголовок страницы')
                    ->schema([
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Заголовок')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('hero_subtitle')
                            ->label('Подзаголовок')
                            ->required()
                            ->rows(3)
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Блок "Почему выбирают нас"')
                    ->schema([
                        Forms\Components\TextInput::make('why_title')
                            ->label('Заголовок')
                            ->required()
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('why_description1')
                            ->label('Первый абзац')
                            ->required()
                            ->rows(3)
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('why_description2')
                            ->label('Второй абзац')
                            ->required()
                            ->rows(3)
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('why_feature1')
                            ->label('Преимущество 1')
                            ->placeholder('Например: Лицензированная деятельность'),

                        Forms\Components\TextInput::make('why_feature2')
                            ->label('Преимущество 2')
                            ->placeholder('Например: Собственный автопарк'),

                        Forms\Components\TextInput::make('why_feature3')
                            ->label('Преимущество 3')
                            ->placeholder('Например: Команда специалистов'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Статистика (4 блока)')
                    ->description('Цифры и достижения')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('stat1_number')
                                    ->label('Цифра 1')
                                    ->placeholder('10K+'),
                                Forms\Components\TextInput::make('stat1_label')
                                    ->label('Подпись 1')
                                    ->placeholder('Выполненных заказов'),

                                Forms\Components\TextInput::make('stat2_number')
                                    ->label('Цифра 2')
                                    ->placeholder('500+'),
                                Forms\Components\TextInput::make('stat2_label')
                                    ->label('Подпись 2')
                                    ->placeholder('Постоянных клиентов'),

                                Forms\Components\TextInput::make('stat3_number')
                                    ->label('Цифра 3')
                                    ->placeholder('15+'),
                                Forms\Components\TextInput::make('stat3_label')
                                    ->label('Подпись 3')
                                    ->placeholder('Единиц техники'),

                                Forms\Components\TextInput::make('stat4_number')
                                    ->label('Цифра 4')
                                    ->placeholder('5'),
                                Forms\Components\TextInput::make('stat4_label')
                                    ->label('Подпись 4')
                                    ->placeholder('Лет на рынке'),
                            ]),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Ценности компании (4 карточки)')
                    ->description('Основные преимущества и ценности')
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\TextInput::make('value1_title')
                                    ->label('Ценность 1 - Название')
                                    ->placeholder('Например: Надежность'),
                                Forms\Components\Textarea::make('value1_description')
                                    ->label('Ценность 1 - Описание')
                                    ->rows(2),

                                Forms\Components\TextInput::make('value2_title')
                                    ->label('Ценность 2 - Название')
                                    ->placeholder('Например: Опытная команда'),
                                Forms\Components\Textarea::make('value2_description')
                                    ->label('Ценность 2 - Описание')
                                    ->rows(2),

                                Forms\Components\TextInput::make('value3_title')
                                    ->label('Ценность 3 - Название')
                                    ->placeholder('Например: Пунктуальность'),
                                Forms\Components\Textarea::make('value3_description')
                                    ->label('Ценность 3 - Описание')
                                    ->rows(2),

                                Forms\Components\TextInput::make('value4_title')
                                    ->label('Ценность 4 - Название')
                                    ->placeholder('Например: Доступные цены'),
                                Forms\Components\Textarea::make('value4_description')
                                    ->label('Ценность 4 - Описание')
                                    ->rows(2),
                            ]),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('№ версии')
                    ->sortable(),

                Tables\Columns\TextColumn::make('hero_title')
                    ->label('Заголовок')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Опубликовано')
                    ->onColor('success')
                    ->offColor('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Опубликовано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->default('—'),

                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Автор')
                    ->default('Система'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Статус')
                    ->placeholder('Все версии')
                    ->trueLabel('Опубликованные')
                    ->falseLabel('Черновики'),
            ])
            ->actions([
                Tables\Actions\Action::make('duplicate')
                    ->label('Дублировать')
                    ->icon('heroicon-o-duplicate')
                    ->color('secondary')
                    ->action(function ($record) {
                        $newRecord = $record->replicate();
                        $newRecord->is_published = false;
                        $newRecord->published_at = null;
                        $newRecord->created_by = auth()->id();
                        $newRecord->save();
                        
                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Версия продублирована')
                            ->body('Создан новый черновик на основе выбранной версии')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Создать копию версии?')
                    ->modalSubheading('Будет создана новая версия со всем содержимым, как черновик'),
                    
                Tables\Actions\EditAction::make()
                    ->label('Редактировать'),
                    
                Tables\Actions\DeleteAction::make()
                    ->label('Удалить')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'desc');
    }
    
    public static function getRelations(): array
    {
        return [];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutContents::route('/'),
            'create' => Pages\CreateAboutContent::route('/create'),
            'edit' => Pages\EditAboutContent::route('/{record}/edit'),
        ];
    }    
}
