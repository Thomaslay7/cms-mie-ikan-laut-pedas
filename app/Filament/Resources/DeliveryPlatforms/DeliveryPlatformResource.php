<?php

namespace App\Filament\Resources\DeliveryPlatforms;

use App\Filament\Resources\DeliveryPlatforms\Pages\CreateDeliveryPlatform;
use App\Filament\Resources\DeliveryPlatforms\Pages\EditDeliveryPlatform;
use App\Filament\Resources\DeliveryPlatforms\Pages\ListDeliveryPlatforms;
use App\Filament\Resources\DeliveryPlatforms\Schemas\DeliveryPlatformForm;
use App\Filament\Resources\DeliveryPlatforms\Tables\DeliveryPlatformsTable;
use App\Models\DeliveryPlatform;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DeliveryPlatformResource extends Resource
{
    protected static ?string $model = DeliveryPlatform::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Delivery Platforms';

    protected static string|UnitEnum|null $navigationGroup = 'Delivery Management';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return DeliveryPlatformForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeliveryPlatformsTable::configure($table);
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
            'index' => ListDeliveryPlatforms::route('/'),
            'create' => CreateDeliveryPlatform::route('/create'),
            'edit' => EditDeliveryPlatform::route('/{record}/edit'),
        ];
    }
}
