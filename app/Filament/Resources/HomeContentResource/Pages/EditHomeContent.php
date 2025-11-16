<?php

namespace App\Filament\Resources\HomeContentResource\Pages;

use App\Filament\Resources\HomeContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeContent extends EditRecord
{
    protected static string $resource = HomeContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Удалить'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
