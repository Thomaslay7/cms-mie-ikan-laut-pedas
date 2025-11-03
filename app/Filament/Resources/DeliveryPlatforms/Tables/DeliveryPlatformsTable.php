<?php

namespace App\Filament\Resources\DeliveryPlatforms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class DeliveryPlatformsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('logo_url')
                    ->label('Logo')
                    ->circular()
                    ->defaultImageUrl(asset('images/default-platform.png')),

                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('commission_rate')
                    ->label('Commission')
                    ->suffix('%')
                    ->alignEnd()
                    ->sortable(),

                \Filament\Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active')
                    ->alignCenter(),

                \Filament\Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->alignCenter()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\Filter::make('is_active')
                    ->label('Active Only')
                    ->query(fn ($query) => $query->where('is_active', true))
                    ->default(),

                \Filament\Tables\Filters\Filter::make('no_commission')
                    ->label('No Commission')
                    ->query(fn ($query) => $query->where('commission_rate', 0)),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
