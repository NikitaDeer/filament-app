<?php

namespace App\Filament\Resources\PricingOptionResource\Pages;

use App\Filament\Resources\PricingOptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPricingOptions extends ListRecords
{
    protected static string $resource = PricingOptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
