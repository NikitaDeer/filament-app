<?php

namespace App\Filament\Resources\ContactsContentResource\Pages;

use App\Filament\Resources\ContactsContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContactsContent extends CreateRecord
{
    protected static string $resource = ContactsContentResource::class;

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
