<?php

namespace App\Filament\Resources\DeliverySettings;

use App\Filament\Resources\DeliverySettings\Pages\ManageDeliverySettings;
use App\Models\DeliverySetting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DeliverySettingResource extends Resource
{
    protected static ?string $model = DeliverySetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('minimum_order')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('delivery_fee')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('free_delivery_threshold')
                    ->numeric(),
                TextInput::make('delivery_radius_km')
                    ->required()
                    ->numeric()
                    ->default(5),
                TextInput::make('estimated_delivery_time_min')
                    ->required()
                    ->numeric()
                    ->default(30),
                TextInput::make('delivery_areas'),
                Toggle::make('is_delivery_enabled')
                    ->required(),
                Toggle::make('is_pickup_enabled')
                    ->required(),
                Textarea::make('delivery_notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('minimum_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('delivery_fee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('free_delivery_threshold')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('delivery_radius_km')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_delivery_time_min')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_delivery_enabled')
                    ->boolean(),
                IconColumn::make('is_pickup_enabled')
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
            'index' => ManageDeliverySettings::route('/'),
        ];
    }
}
