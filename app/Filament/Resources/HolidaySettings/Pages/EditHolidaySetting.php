<?php

namespace App\Filament\Resources\HolidaySettings\Pages;

use App\Filament\Resources\HolidaySettings\HolidaySettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHolidaySetting extends EditRecord
{
    protected static string $resource = HolidaySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
