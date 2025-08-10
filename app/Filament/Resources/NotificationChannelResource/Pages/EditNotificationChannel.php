<?php

namespace App\Filament\Resources\NotificationChannelResource\Pages;

use App\Filament\Resources\NotificationChannelResource;
use App\Models\NotificationChannel;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotificationChannel extends EditRecord
{
    protected static string $resource = NotificationChannelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Если текущий канал установлен как канал по умолчанию, сбросить все другие
        if ($this->record->is_default) {
            NotificationChannel::where('id', '!=', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        // Гарантируем единственность активного канала внутри одного type
        if ($this->record->is_active) {
            NotificationChannel::where('id', '!=', $this->record->id)
                ->where('type', $this->record->type)
                ->update(['is_active' => false]);
        }
    }
}
