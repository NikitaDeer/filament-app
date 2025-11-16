<?php

namespace App\Filament\Resources\FleetContentResource\Pages;

use App\Filament\Resources\FleetContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFleetContents extends ListRecords
{
    protected static string $resource = FleetContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
