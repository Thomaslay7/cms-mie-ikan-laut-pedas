<?php

namespace App\Filament\Resources\BusinessInfos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class BusinessInfosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('business_name')
                    ->label('Business Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tagline')
                    ->label('Tagline')
                    ->limit(50)
                    ->searchable(),

                ImageColumn::make('logo_url')
                    ->label('Logo')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(url('images/placeholder-logo.svg'))
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->tooltip(fn($record) => $record->business_name . ' Logo'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
