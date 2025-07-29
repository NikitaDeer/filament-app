<?php

namespace App\Filament\Resources\PriceCategoryResource\Pages;

use App\Filament\Resources\PriceCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPriceCategory extends EditRecord
{
    protected static string $resource = PriceCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
