<?php

namespace App\Filament\Resources\DeliverySettings\Pages;

use App\Filament\Resources\DeliverySettings\DeliverySettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDeliverySettings extends ManageRecords
{
    protected static string $resource = DeliverySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
