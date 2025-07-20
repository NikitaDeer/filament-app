<?php

namespace App\Filament\Resources\NotificationChannelResource\Pages;

use App\Filament\Resources\NotificationChannelResource;
use App\Models\NotificationChannel;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNotificationChannel extends CreateRecord
{
    protected static string $resource = NotificationChannelResource::class;
    
    protected function afterCreate(): void
    {
        // Если текущий канал установлен как канал по умолчанию, сбросить все другие
        if ($this->record->is_default) {
            NotificationChannel::where('id', '!=', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}
