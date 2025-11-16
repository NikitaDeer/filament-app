<?php

namespace App\Filament\Resources\ContactsContentResource\Pages;

use App\Filament\Resources\ContactsContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactsContents extends ListRecords
{
    protected static string $resource = ContactsContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
