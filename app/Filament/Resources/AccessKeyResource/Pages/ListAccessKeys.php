<?php

namespace App\Filament\Resources\AccessKeyResource\Pages;

use App\Filament\Resources\AccessKeyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccessKeys extends ListRecords
{
    protected static string $resource = AccessKeyResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
