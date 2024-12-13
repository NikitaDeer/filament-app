<?php

namespace App\Filament\Resources\TariffResource\Pages;

use App\Filament\Resources\TariffResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTariffs extends ListRecords
{
    protected static string $resource = TariffResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
