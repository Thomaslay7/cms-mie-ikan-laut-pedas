<?php

namespace App\Filament\Resources\BusinessInfos\Pages;

use App\Filament\Resources\BusinessInfos\BusinessInfoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBusinessInfo extends EditRecord
{
    protected static string $resource = BusinessInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
