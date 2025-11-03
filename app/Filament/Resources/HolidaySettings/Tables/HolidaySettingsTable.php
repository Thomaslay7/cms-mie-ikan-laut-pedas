<?php

namespace App\Filament\Resources\HolidaySettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HolidaySettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Acara/Libur')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),

                IconColumn::make('is_closed')
                    ->label('Status Toko')
                    ->boolean()
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('danger')
                    ->falseColor('warning'),

                TextColumn::make('special_hours')
                    ->label('Jam Khusus')
                    ->getStateUsing(function ($record) {
                        if ($record->is_closed) {
                            return 'TUTUP';
                        }
                        if ($record->special_opening_time || $record->special_closing_time) {
                            return ($record->special_opening_time ?? 'Normal') . ' - ' . ($record->special_closing_time ?? 'Normal');
                        }
                        return 'Jam Normal';
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'TUTUP' ? 'danger' : ($state === 'Jam Normal' ? 'success' : 'warning')),

                IconColumn::make('is_recurring')
                    ->label('Berulang')
                    ->boolean()
                    ->trueIcon('heroicon-o-arrow-path')
                    ->falseIcon('heroicon-o-calendar')
                    ->trueColor('info')
                    ->falseColor('gray'),

                TextColumn::make('recurrence_type')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match($state) {
                        'yearly' => 'Tahunan',
                        'monthly' => 'Bulanan',
                        default => '-'
                    })
                    ->color('info'),

                TextColumn::make('description')
                    ->label('Catatan')
                    ->limit(30)
                    ->toggleable(),
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
