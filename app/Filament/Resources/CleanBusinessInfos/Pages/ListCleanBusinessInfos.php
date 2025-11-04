<?php

namespace App\Filament\Resources\CleanBusinessInfos\Pages;

use App\Filament\Resources\CleanBusinessInfos\CleanBusinessInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCleanBusinessInfos extends ListRecords
{
    protected static string $resource = CleanBusinessInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
