<?php

namespace App\Filament\Resources\HolidaySettings;

use App\Filament\Resources\HolidaySettings\Pages\CreateHolidaySetting;
use App\Filament\Resources\HolidaySettings\Pages\EditHolidaySetting;
use App\Filament\Resources\HolidaySettings\Pages\ListHolidaySettings;
use App\Filament\Resources\HolidaySettings\Schemas\HolidaySettingForm;
use App\Filament\Resources\HolidaySettings\Tables\HolidaySettingsTable;
use App\Models\HolidaySetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HolidaySettingResource extends Resource
{
    protected static ?string $model = HolidaySetting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Atur Hari Libur';

    protected static ?string $modelLabel = 'Hari Libur';

    protected static ?string $pluralModelLabel = 'Pengaturan Hari Libur';

    protected static string|\UnitEnum|null $navigationGroup = 'Jadwal Toko';

    public static function form(Schema $schema): Schema
    {
        return HolidaySettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HolidaySettingsTable::configure($table);
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
            'index' => ListHolidaySettings::route('/'),
            'create' => CreateHolidaySetting::route('/create'),
            'edit' => EditHolidaySetting::route('/{record}/edit'),
        ];
    }
}
