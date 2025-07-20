<?php

namespace App\Filament\Resources\NotificationChannelResource\Pages;

use App\Filament\Resources\NotificationChannelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotificationChannels extends ListRecords
{
    protected static string $resource = NotificationChannelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
