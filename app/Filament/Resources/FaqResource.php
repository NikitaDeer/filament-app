<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'FAQ (Вопросы-Ответы)';

    protected static ?string $modelLabel = 'вопрос';

    protected static ?string $pluralModelLabel = 'вопросы';

    protected static ?string $navigationGroup = 'Контент сайта';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('question')
                            ->label('Вопрос')
                            ->required()
                            ->maxLength(500)
                            ->columnSpan(2)
                            ->placeholder('Например: Сколько стоит доставка по городу?'),

                        Forms\Components\RichEditor::make('answer')
                            ->label('Ответ')
                            ->required()
                            ->columnSpan(2)
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'link',
                                'bulletList',
                                'orderedList',
                            ]),

                        Forms\Components\Select::make('category')
                            ->label('Категория')
                            ->options([
                                'Общие вопросы' => 'Общие вопросы',
                                'Стоимость и оплата' => 'Стоимость и оплата',
                                'Транспорт и доставка' => 'Транспорт и доставка',
                                'Услуги и дополнительные опции' => 'Услуги и дополнительные опции',
                                'Заказ и оформление' => 'Заказ и оформление',
                                'Грузчики и упаковка' => 'Грузчики и упаковка',
                            ])
                            ->required()
                            ->default('Общие вопросы')
                            ->searchable(),

                        Forms\Components\TextInput::make('order')
                            ->label('Порядок сортировки')
                            ->numeric()
                            ->default(0)
                            ->helperText('Чем меньше число, тем выше в списке'),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Опубликовано')
                            ->default(true)
                            ->helperText('Показывать на сайте'),

                        Forms\Components\Toggle::make('is_popular')
                            ->label('Популярный вопрос')
                            ->default(false)
                            ->helperText('Будет показан на главной странице'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('question')
                    ->label('Вопрос')
                    ->limit(60)
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\BadgeColumn::make('category')
                    ->label('Категория')
                    ->colors([
                        'primary' => 'Общие вопросы',
                        'success' => 'Стоимость и оплата',
                        'warning' => 'Транспорт и доставка',
                        'danger' => 'Услуги и дополнительные опции',
                        'secondary' => 'Заказ и оформление',
                        'info' => 'Грузчики и упаковка',
                    ])
                    ->searchable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Порядок')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Опубликовано')
                    ->onColor('success')
                    ->offColor('danger'),

                Tables\Columns\IconColumn::make('is_popular')
                    ->label('Популярный')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Категория')
                    ->options([
                        'Общие вопросы' => 'Общие вопросы',
                        'Стоимость и оплата' => 'Стоимость и оплата',
                        'Транспорт и доставка' => 'Транспорт и доставка',
                        'Услуги и дополнительные опции' => 'Услуги и дополнительные опции',
                        'Заказ и оформление' => 'Заказ и оформление',
                        'Грузчики и упаковка' => 'Грузчики и упаковка',
                    ]),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Опубликовано')
                    ->placeholder('Все')
                    ->trueLabel('Да')
                    ->falseLabel('Нет'),
                Tables\Filters\TernaryFilter::make('is_popular')
                    ->label('Популярные')
                    ->placeholder('Все')
                    ->trueLabel('Да')
                    ->falseLabel('Нет'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('publish')
                    ->label('Опубликовать')
                    ->icon('heroicon-o-check')
                    ->action(fn ($records) => $records->each->update(['is_published' => true]))
                    ->deselectRecordsAfterCompletion()
                    ->color('success'),
                Tables\Actions\BulkAction::make('unpublish')
                    ->label('Снять с публикации')
                    ->icon('heroicon-o-x')
                    ->action(fn ($records) => $records->each->update(['is_published' => false]))
                    ->deselectRecordsAfterCompletion()
                    ->color('danger'),
                Tables\Actions\DeleteBulkAction::make()->label('Удалить выбранные'),
            ])
            ->defaultSort('order', 'asc');
    }
    
    public static function getRelations(): array
    {
        return [];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }    
}
