<?php

namespace App\Filament\Resources\BusinessInfoResource\Pages;

use App\Filament\Resources\BusinessInfoResource;
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
