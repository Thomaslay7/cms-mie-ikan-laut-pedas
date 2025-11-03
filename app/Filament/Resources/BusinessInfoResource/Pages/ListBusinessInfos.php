<?php

namespace App\Filament\Resources\BusinessInfoResource\Pages;

use App\Filament\Resources\BusinessInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBusinessInfos extends ListRecords
{
    protected static string $resource = BusinessInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
