<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PageResource\RelationManagers;

class PageResource extends Resource
{
  protected static ?string $model = Page::class;

  protected static ?string $navigationIcon = 'heroicon-o-document-text';
  protected static ?string $navigationGroup = 'Управление отображаемой информации на web-странице';

  protected static ?string $navigationLabel = 'Публикуемая информация';

  public static function getModelLabel(): string { return 'Страница'; }
  public static function getPluralModelLabel(): string { return 'Страницы'; }

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Верхняя часть страницы')
          ->schema([
            TextInput::make('FirstTitle')->label(__('Заголовок:')),
            FileUpload::make('main_photo_path')
              ->image()
              ->directory('images')
              ->visibility('public')
              ->label(__('Основная фотография:')),
            Textarea::make('content')->label(__('Содержимое:')),
          ]),

        Section::make('Основная информация')
          ->schema([
            TextInput::make('SecondTitle')->label(__('Заголовок:')),
            Textarea::make('main_content')->label(__('Содержимое:')),
          ]),

        Section::make('О нас')
          ->schema([
            TextInput::make('ThirdTitle')->label(__('Заголовок:')),
            FileUpload::make('first_photo_path')
              ->image()
              ->directory('images')
              ->visibility('public')
              ->label(__('Фотография 1:')),
            FileUpload::make('second_photo_path')
              ->image()
              ->directory('images')
              ->visibility('public')
              ->label(__('Фотография 2:')),
            Textarea::make('about_content')->label(__('Содержимое. 1 часть:')),
            Textarea::make('about_second_content')->label(__('Содержимое. 2 часть:')),
          ]),


        Section::make('Заключительная часть')
          ->schema([
            TextInput::make('FourthTitle')->label(__('Заголовок:')),
            Textarea::make('footer_content')->label(__('Содержимое. 1 часть:')),
            Textarea::make('footer_second_content')->label(__('Содержимое. 2 часть:')),
          ]),

        Toggle::make('is_published')->label(__('Опубликовать')),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('FirstTitle')
          ->searchable()
          ->sortable()
          ->label('Заголовок 1')
          ->limit(10),
        TextColumn::make('SecondTitle')
          ->searchable()
          ->sortable()
          ->label('Заголовок 2')
          ->limit(10),
        TextColumn::make('ThirdTitle')
          ->searchable()
          ->sortable()
          ->label('Заголовок 3')
          ->limit(10),
        TextColumn::make('FourthTitle')
          ->searchable()
          ->sortable()
          ->label('Заголовок 4')
          ->limit(10),
        ImageColumn::make('main_photo_path')->circular()->label('Основное фото'),
        ImageColumn::make('first_photo_path')->circular()->label('Фото 1'),
        ImageColumn::make('second_photo_path')->circular()->label('Фото 2'),
        ToggleColumn::make('is_published')
          ->sortable()
          ->label('Опубликованно'),
        TextColumn::make('created_at')
          ->dateTime('Y-m-d H:i')
          ->label('Дата создания'),


      ])
      ->filters([
        //
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
      'index' => Pages\ListPages::route('/'),
      'create' => Pages\CreatePage::route('/create'),
      'edit' => Pages\EditPage::route('/{record}/edit'),
    ];
  }
}
