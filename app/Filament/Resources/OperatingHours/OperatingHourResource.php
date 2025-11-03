<?php

namespace App\Filament\Resources\OperatingHours;

use App\Filament\Resources\OperatingHours\Pages\ManageOperatingHours;
use App\Models\OperatingHour;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OperatingHourResource extends Resource
{
    protected static ?string $model = OperatingHour::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Jam Operasional';

    protected static ?string $modelLabel = 'Jam Operasional';

    protected static ?string $pluralModelLabel = 'Jam Operasional Harian';

    protected static string|\UnitEnum|null $navigationGroup = 'Jadwal Toko';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('day_of_week')
                    ->options([
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
        ])
                    ->required(),
                TimePicker::make('opening_time'),
                TimePicker::make('closing_time'),
                Toggle::make('is_closed')
                    ->required(),
                Toggle::make('is_24_hours')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day_of_week')
                    ->badge(),
                TextColumn::make('opening_time')
                    ->time()
                    ->sortable(),
                TextColumn::make('closing_time')
                    ->time()
                    ->sortable(),
                IconColumn::make('is_closed')
                    ->boolean(),
                IconColumn::make('is_24_hours')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageOperatingHours::route('/'),
        ];
    }
}
