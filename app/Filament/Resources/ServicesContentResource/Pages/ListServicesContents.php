<?php

namespace App\Filament\Resources\ServicesContentResource\Pages;

use App\Filament\Resources\ServicesContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServicesContents extends ListRecords
{
    protected static string $resource = ServicesContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
