<?php

namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms;
use App\Models\Service;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Filament\Resources\ServiceResource\Pages;

class ServiceResource extends Resource
{
  protected static ?string $model = Service::class;

  protected static ?string $navigationIcon = 'heroicon-o-collection';
  public static function getModelLabel(): string { return 'Услуга'; }
  public static function getPluralModelLabel(): string { return 'Услуги'; }
  protected static ?string $navigationGroup = 'Управление существующими услугами';
  protected static ?string $navigationLabel = 'Услуги';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('Название услуги')
          ->schema([
            Forms\Components\TextInput::make('name')
              ->label('Название услуги')
              ->required()
              ->maxLength(100),
          ])->columns(2),

        Section::make('Ценообразование')
          ->schema([
            Select::make('pricing_type')
              ->label('Тип цены')
              ->options([
                'fixed' => 'Фиксированная цена',
                'hourly' => 'Руб/час',
              ])
              ->required()
              ->default('fixed'),

            Forms\Components\TextInput::make('price')
              ->label('Цена')
              ->numeric()
              ->minValue(0)
              ->step(0.1)
              ->required()
              ->helperText('Укажите стоимость в рублях.'),
          ])->columns(2),


        Section::make('Описание услуги')
          ->schema([
        Forms\Components\Textarea::make('description')
          ->label('Краткое описание')
          ->required()
          ->maxLength(1000)
          ->columnSpan('full'),
        Forms\Components\TagsInput::make('features')
          ->label('Особенности услуги')
          ->placeholder('Добавьте особенность и нажмите Enter')
          ->columnSpan('full'),
        ])->columns(2),

        Section::make('Опубликовать')
          ->schema([
            Forms\Components\Toggle::make('is_published')
              ->label('Опубликовано')
              ->default(true),
            Forms\Components\Toggle::make('is_popular')
              ->label('Популярная услуга')
              ->default(false),
            Forms\Components\Toggle::make('is_calculator_option')
              ->label('Доступна в калькуляторе')
              ->default(false)
              ->helperText('Если включено, услуга будет отображаться в калькуляторе стоимости'),
            Forms\Components\Select::make('icon')
              ->label('Иконка')
              ->options([
                'fas fa-box' => '📦 Коробка (fas fa-box)',
                'fas fa-boxes' => '📦 Коробки (fas fa-boxes)',
                'fas fa-tools' => '🔧 Инструменты (fas fa-tools)',
                'fas fa-trash' => '🗑️ Мусорное ведро (fas fa-trash)',
                'fas fa-shield-alt' => '🛡️ Щит (fas fa-shield-alt)',
                'fas fa-bolt' => '⚡ Молния (fas fa-bolt)',
                'fas fa-truck' => '🚚 Грузовик (fas fa-truck)',
                'fas fa-truck-loading' => '🚛 Погрузка (fas fa-truck-loading)',
                'fas fa-hard-hat' => '⛑️ Каска (fas fa-hard-hat)',
                'fas fa-warehouse' => '🏢 Склад (fas fa-warehouse)',
                'fas fa-road' => '🛣️ Дорога (fas fa-road)',
                'fas fa-box-open' => '📭 Открытая коробка (fas fa-box-open)',
                'fas fa-dolly' => '🛒 Тележка (fas fa-dolly)',
                'fas fa-pallet' => '📦 Паллета (fas fa-pallet)',
                'fas fa-people-carry' => '👥 Люди несут (fas fa-people-carry)',
                'fas fa-hand-holding-usd' => '💵 Деньги (fas fa-hand-holding-usd)',
                'fas fa-clock' => '⏰ Часы (fas fa-clock)',
                'fas fa-calendar-alt' => '📅 Календарь (fas fa-calendar-alt)',
                'fas fa-map-marked-alt' => '🗺️ Карта (fas fa-map-marked-alt)',
                'fas fa-wrench' => '🔧 Гаечный ключ (fas fa-wrench)',
                'fas fa-hammer' => '🔨 Молоток (fas fa-hammer)',
                'fas fa-screwdriver' => '🪛 Отвертка (fas fa-screwdriver)',
                'fas fa-tape' => '📏 Лента (fas fa-tape)',
                'fas fa-couch' => '🛋️ Диван (fas fa-couch)',
                'fas fa-bed' => '🛏️ Кровать (fas fa-bed)',
                'fas fa-chair' => '🪑 Стул (fas fa-chair)',
                'fas fa-home' => '🏠 Дом (fas fa-home)',
                'fas fa-building' => '🏢 Здание (fas fa-building)',
                'fas fa-box-tissue' => '📦 Упаковка (fas fa-box-tissue)',
                'fas fa-recycle' => '♻️ Переработка (fas fa-recycle)',
              ])
              ->searchable()
              ->placeholder('Выберите иконку')
              ->helperText('Выберите подходящую иконку для услуги'),
          ])->columns(2),
      ]);

  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Название')
          ->searchable()
          ->limit(30)
          ->tooltip(fn ($record) => $record->name),

        Tables\Columns\TextColumn::make('price')
          ->label('Цена')
          ->formatStateUsing(function ($state, $record) {
            if ($record && $record->pricing_type === 'hourly') {
              return number_format((float) $state, 0, '.', ' ') . ' ₽/час';
            }
            return 'от ' . number_format((float) $state, 0, '.', ' ') . ' ₽';
          })
          ->sortable(),

        Tables\Columns\BadgeColumn::make('pricing_type')
          ->label('Тип цены')
          ->colors([
            'success' => 'fixed',
            'warning' => 'hourly',
          ])
          ->formatStateUsing(fn ($state) => $state === 'hourly' ? 'Руб/час' : 'Фикс.'),

        Tables\Columns\ToggleColumn::make('is_published')
          ->label('Опубликовано')
          ->onColor('success')
          ->offColor('danger'),
        
        Tables\Columns\ToggleColumn::make('is_popular')
          ->label('Популярная')
          ->onColor('warning')
          ->offColor('secondary'),
        
        Tables\Columns\ToggleColumn::make('is_calculator_option')
          ->label('В калькуляторе')
          ->onColor('primary')
          ->offColor('secondary'),
      ])
      ->filters([
        Tables\Filters\TernaryFilter::make('is_published')
          ->label('Опубликовано')
          ->placeholder('Все услуги')
          ->trueLabel('Опубликованные')
          ->falseLabel('Неопубликованные'),
        
        Tables\Filters\TernaryFilter::make('is_calculator_option')
          ->label('В калькуляторе')
          ->placeholder('Все услуги')
          ->trueLabel('В калькуляторе')
          ->falseLabel('Не в калькуляторе'),
        
        Tables\Filters\TernaryFilter::make('is_popular')
          ->label('Популярность')
          ->placeholder('Все услуги')
          ->trueLabel('Популярные')
          ->falseLabel('Обычные'),
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
        Tables\Actions\BulkAction::make('publish')
          ->label('Опубликовать')
          ->icon('heroicon-o-check-circle')
          ->action(fn ($records) => $records->each->update(['is_published' => true]))
          ->deselectRecordsAfterCompletion()
          ->color('success'),
        Tables\Actions\BulkAction::make('unpublish')
          ->label('Снять с публикации')
          ->icon('heroicon-o-x-circle')
          ->action(fn ($records) => $records->each->update(['is_published' => false]))
          ->deselectRecordsAfterCompletion()
          ->color('danger'),
        Tables\Actions\BulkAction::make('addToCalculator')
          ->label('Добавить в калькулятор')
          ->icon('heroicon-o-calculator')
          ->action(fn ($records) => $records->each->update(['is_calculator_option' => true]))
          ->deselectRecordsAfterCompletion()
          ->color('primary'),
        Tables\Actions\BulkAction::make('removeFromCalculator')
          ->label('Убрать из калькулятора')
          ->icon('heroicon-o-minus-circle')
          ->action(fn ($records) => $records->each->update(['is_calculator_option' => false]))
          ->deselectRecordsAfterCompletion()
          ->color('warning'),
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
      'index' => Pages\ListServices::route('/'),
      'create' => Pages\CreateService::route('/create'),
      'edit' => Pages\EditService::route('/{record}/edit'),
    ];
  }
}
