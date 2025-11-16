<?php

namespace App\Filament\Resources\ContactsContentResource\Pages;

use App\Filament\Resources\ContactsContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactsContent extends EditRecord
{
    protected static string $resource = ContactsContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
