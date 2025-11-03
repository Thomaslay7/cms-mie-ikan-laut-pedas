<?php

namespace App\Filament\Resources\HolidaySettings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HolidaySettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Acara/Libur')
                    ->required()
                    ->placeholder('Contoh: Hari Raya Nyepi, Maintenance Toko, dll')
                    ->maxLength(255),

                DatePicker::make('date')
                    ->label('Tanggal')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),

                Toggle::make('is_closed')
                    ->label('Toko Tutup Total')
                    ->helperText('Aktifkan jika toko tutup sepenuhnya di tanggal ini')
                    ->reactive()
                    ->default(true),

                TimePicker::make('special_opening_time')
                    ->label('Jam Buka Khusus')
                    ->hidden(fn ($get) => $get('is_closed'))
                    ->helperText('Kosongkan jika menggunakan jam buka normal'),

                TimePicker::make('special_closing_time')
                    ->label('Jam Tutup Khusus')
                    ->hidden(fn ($get) => $get('is_closed'))
                    ->helperText('Kosongkan jika menggunakan jam tutup normal'),

                Toggle::make('is_recurring')
                    ->label('Berulang Setiap Tahun')
                    ->helperText('Contoh: Hari Kemerdekaan, Tahun Baru, dll')
                    ->reactive()
                    ->default(false),

                Select::make('recurrence_type')
                    ->label('Tipe Pengulangan')
                    ->options([
                        'yearly' => 'Tahunan (setiap tahun di tanggal yang sama)',
                        'monthly' => 'Bulanan (setiap bulan di tanggal yang sama)'
                    ])
                    ->visible(fn ($get) => $get('is_recurring'))
                    ->default('yearly'),

                Textarea::make('description')
                    ->label('Catatan')
                    ->placeholder('Contoh: Toko tutup untuk perayaan hari raya')
                    ->columnSpanFull()
                    ->rows(3),
            ]);
    }
}
