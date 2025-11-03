<?php

namespace App\Filament\Resources\ChefInfos\Pages;

use App\Filament\Resources\ChefInfos\ChefInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageChefInfos extends ManageRecords
{
    protected static string $resource = ChefInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
