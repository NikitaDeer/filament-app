<?php

namespace App\Filament\Resources\AboutContentResource\Pages;

use App\Filament\Resources\AboutContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutContents extends ListRecords
{
    protected static string $resource = AboutContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Создать новую версию'),
        ];
    }
}
