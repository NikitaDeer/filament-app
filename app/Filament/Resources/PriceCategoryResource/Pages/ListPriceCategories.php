<?php

namespace App\Filament\Resources\PriceCategoryResource\Pages;

use App\Filament\Resources\PriceCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPriceCategories extends ListRecords
{
    protected static string $resource = PriceCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
