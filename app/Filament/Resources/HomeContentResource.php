<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeContentResource\Pages;
use App\Models\HomeContent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class HomeContentResource extends Resource
{
    protected static ?string $model = HomeContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Главная страница';

    protected static ?string $modelLabel = 'версия';

    protected static ?string $pluralModelLabel = 'версии главной';

    protected static ?string $navigationGroup = 'Контент сайта';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero-секция (Верхний блок)')
                    ->description('Главный баннер на странице')
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

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('hero_feature1')
                                    ->label('Преимущество 1')
                                    ->placeholder('Например: Работаем 24/7'),

                                Forms\Components\TextInput::make('hero_feature2')
                                    ->label('Преимущество 2')
                                    ->placeholder('Например: Опытные грузчики'),

                                Forms\Components\TextInput::make('hero_feature3')
                                    ->label('Преимущество 3')
                                    ->placeholder('Например: Страхование груза'),

                                Forms\Components\TextInput::make('hero_feature4')
                                    ->label('Преимущество 4')
                                    ->placeholder('Например: Фиксированные цены'),
                            ]),

                        Forms\Components\FileUpload::make('hero_image')
                            ->label('Изображение справа')
                            ->image()
                            ->directory('hero-images')
                            ->maxSize(5120)
                            ->helperText('Рекомендуемый размер: 800x600px')
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Статистика (Цифры)')
                    ->description('Блок с цифрами и достижениями')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('stats_clients')
                                    ->label('Количество клиентов')
                                    ->placeholder('500+'),

                                Forms\Components\TextInput::make('stats_clients_label')
                                    ->label('Подпись')
                                    ->placeholder('Довольных клиентов'),

                                Forms\Components\TextInput::make('stats_availability')
                                    ->label('Доступность')
                                    ->placeholder('24/7'),

                                Forms\Components\TextInput::make('stats_availability_label')
                                    ->label('Подпись')
                                    ->placeholder('Работаем круглосуточно'),

                                Forms\Components\TextInput::make('stats_years')
                                    ->label('Лет на рынке')
                                    ->placeholder('5 лет'),

                                Forms\Components\TextInput::make('stats_years_label')
                                    ->label('Подпись')
                                    ->placeholder('Опыт работы'),
                            ]),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Преимущества компании')
                    ->description('Почему выбирают нас')
                    ->schema([
                        Forms\Components\TextInput::make('advantages_title')
                            ->label('Заголовок секции')
                            ->required()
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('advantages_subtitle')
                            ->label('Подзаголовок секции')
                            ->rows(2)
                            ->columnSpan(2),

                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\TextInput::make('advantages_adv1_title')
                                    ->label('Преимущество 1 - Название'),
                                Forms\Components\Textarea::make('advantages_adv1_description')
                                    ->label('Преимущество 1 - Описание')
                                    ->rows(2),
                                
                                Forms\Components\TextInput::make('advantages_adv2_title')
                                    ->label('Преимущество 2 - Название'),
                                Forms\Components\Textarea::make('advantages_adv2_description')
                                    ->label('Преимущество 2 - Описание')
                                    ->rows(2),
                                
                                Forms\Components\TextInput::make('advantages_adv3_title')
                                    ->label('Преимущество 3 - Название'),
                                Forms\Components\Textarea::make('advantages_adv3_description')
                                    ->label('Преимущество 3 - Описание')
                                    ->rows(2),
                            ]),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('О компании')
                    ->description('Раздел о нашей компании')
                    ->schema([
                        Forms\Components\TextInput::make('about_title')
                            ->label('Заголовок')
                            ->required()
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('about_subtitle')
                            ->label('Подзаголовок')
                            ->required()
                            ->rows(3)
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('about_history_title')
                            ->label('Заголовок истории')
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('about_description1')
                            ->label('Описание 1')
                            ->rows(3)
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('about_description2')
                            ->label('Описание 2')
                            ->rows(3)
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Автопарк')
                    ->description('Заголовок секции с автопарком')
                    ->schema([
                        Forms\Components\TextInput::make('fleet_title')
                            ->label('Заголовок')
                            ->required(),

                        Forms\Components\Textarea::make('fleet_subtitle')
                            ->label('Подзаголовок')
                            ->rows(2),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Услуги')
                    ->description('Заголовок секции с услугами')
                    ->schema([
                        Forms\Components\TextInput::make('services_title')
                            ->label('Заголовок')
                            ->required(),

                        Forms\Components\Textarea::make('services_subtitle')
                            ->label('Подзаголовок')
                            ->rows(2),
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
                    ->label('Заголовок Hero')
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
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeContents::route('/'),
            'create' => Pages\CreateHomeContent::route('/create'),
            'edit' => Pages\EditHomeContent::route('/{record}/edit'),
        ];
    }    
}
