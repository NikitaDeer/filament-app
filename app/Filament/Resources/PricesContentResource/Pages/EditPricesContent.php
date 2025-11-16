<?php

namespace App\Filament\Resources\PricesContentResource\Pages;

use App\Filament\Resources\PricesContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPricesContent extends EditRecord
{
    protected static string $resource = PricesContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
