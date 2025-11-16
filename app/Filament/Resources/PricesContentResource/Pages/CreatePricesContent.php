<?php

namespace App\Filament\Resources\PricesContentResource\Pages;

use App\Filament\Resources\PricesContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePricesContent extends CreateRecord
{
    protected static string $resource = PricesContentResource::class;

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
