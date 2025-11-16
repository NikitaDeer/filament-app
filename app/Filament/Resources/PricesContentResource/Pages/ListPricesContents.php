<?php

namespace App\Filament\Resources\PricesContentResource\Pages;

use App\Filament\Resources\PricesContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPricesContents extends ListRecords
{
    protected static string $resource = PricesContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
