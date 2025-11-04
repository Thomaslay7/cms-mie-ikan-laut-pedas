<?php

namespace App\Filament\Resources\CleanBusinessInfos\Pages;

use App\Filament\Resources\CleanBusinessInfos\CleanBusinessInfoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCleanBusinessInfo extends EditRecord
{
    protected static string $resource = CleanBusinessInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
