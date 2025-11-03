<?php

namespace App\Filament\Resources\BusinessInfos;

use App\Filament\Resources\BusinessInfos\Pages\CreateBusinessInfo;
use App\Filament\Resources\BusinessInfos\Pages\EditBusinessInfo;
use App\Filament\Resources\BusinessInfos\Pages\ListBusinessInfos;
use App\Filament\Resources\BusinessInfos\Schemas\BusinessInfoForm;
use App\Filament\Resources\BusinessInfos\Tables\BusinessInfosTable;
use App\Models\BusinessInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class BusinessInfoResource extends Resource
{
    protected static ?string $model = BusinessInfo::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Business Info';

    protected static ?string $modelLabel = 'Business Info';

    protected static ?string $pluralModelLabel = 'Business Infos';

    public static function form(Schema $schema): Schema
    {
        return BusinessInfoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BusinessInfosTable::configure($table);
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
            'index' => ListBusinessInfos::route('/'),
            'create' => CreateBusinessInfo::route('/create'),
            'edit' => EditBusinessInfo::route('/{record}/edit'),
        ];
    }
}
