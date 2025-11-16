<?php

namespace App\Filament\Resources\ServicesContentResource\Pages;

use App\Filament\Resources\ServicesContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServicesContent extends EditRecord
{
    protected static string $resource = ServicesContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
