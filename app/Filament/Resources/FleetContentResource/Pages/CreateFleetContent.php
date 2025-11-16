<?php

namespace App\Filament\Resources\FleetContentResource\Pages;

use App\Filament\Resources\FleetContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFleetContent extends CreateRecord
{
    protected static string $resource = FleetContentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
