<?php

namespace App\Filament\Resources\BusinessInfos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class BusinessInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('business_name')
                    ->label('Nama Bisnis')
                    ->required()
                    ->maxLength(150),

                TextInput::make('tagline')
                    ->label('Tagline')
                    ->maxLength(255),

                FileUpload::make('logo')
                    ->label('Logo Bisnis')
                    ->image()
                    ->directory('business')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/svg+xml'])
                    ->maxSize(2048)
                    ->helperText('Upload logo bisnis (PNG, JPG, GIF, atau SVG - Maksimal 2MB)'),
            ]);
    }
}
