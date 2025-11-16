<?php

namespace App\Filament\Resources\FleetContentResource\Pages;

use App\Filament\Resources\FleetContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFleetContent extends EditRecord
{
    protected static string $resource = FleetContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
