<?php

namespace App\Filament\Resources\TariffResource\Pages;

use App\Filament\Resources\TariffResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTariff extends EditRecord
{
    protected static string $resource = TariffResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
