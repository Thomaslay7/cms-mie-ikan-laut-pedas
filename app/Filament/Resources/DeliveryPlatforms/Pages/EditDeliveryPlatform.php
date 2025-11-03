<?php

namespace App\Filament\Resources\DeliveryPlatforms\Pages;

use App\Filament\Resources\DeliveryPlatforms\DeliveryPlatformResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryPlatform extends EditRecord
{
    protected static string $resource = DeliveryPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
