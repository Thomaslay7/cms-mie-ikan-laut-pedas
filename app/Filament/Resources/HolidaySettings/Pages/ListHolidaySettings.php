<?php

namespace App\Filament\Resources\HolidaySettings\Pages;

use App\Filament\Resources\HolidaySettings\HolidaySettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHolidaySettings extends ListRecords
{
    protected static string $resource = HolidaySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
