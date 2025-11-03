<?php

namespace App\Filament\Resources\DeliveryPlatforms\Pages;

use App\Filament\Resources\DeliveryPlatforms\DeliveryPlatformResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeliveryPlatforms extends ListRecords
{
    protected static string $resource = DeliveryPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
