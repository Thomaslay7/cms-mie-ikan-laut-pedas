<?php

namespace App\Filament\Resources\CleanBusinessInfos;

use App\Filament\Resources\CleanBusinessInfos\Pages\CreateCleanBusinessInfo;
use App\Filament\Resources\CleanBusinessInfos\Pages\EditCleanBusinessInfo;
use App\Filament\Resources\CleanBusinessInfos\Pages\ListCleanBusinessInfos;
use App\Filament\Resources\CleanBusinessInfos\Schemas\CleanBusinessInfoForm;
use App\Filament\Resources\CleanBusinessInfos\Tables\CleanBusinessInfosTable;
use App\Models\CleanBusinessInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CleanBusinessInfoResource extends Resource
{
    protected static ?string $model = CleanBusinessInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title attribute';

    public static function form(Schema $schema): Schema
    {
        return CleanBusinessInfoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CleanBusinessInfosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCleanBusinessInfos::route('/'),
            'create' => CreateCleanBusinessInfo::route('/create'),
            'edit' => EditCleanBusinessInfo::route('/{record}/edit'),
        ];
    }
}
