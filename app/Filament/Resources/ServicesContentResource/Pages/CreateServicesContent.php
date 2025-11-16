<?php

namespace App\Filament\Resources\ServicesContentResource\Pages;

use App\Filament\Resources\ServicesContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServicesContent extends CreateRecord
{
    protected static string $resource = ServicesContentResource::class;

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
