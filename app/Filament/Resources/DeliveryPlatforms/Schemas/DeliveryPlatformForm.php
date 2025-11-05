<?php

namespace App\Filament\Resources\DeliveryPlatforms\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class DeliveryPlatformForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('business_info_id')
                    ->relationship('businessInfo', 'business_name')
                    ->default(1)
                    ->searchable()
                    ->preload(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g. GrabFood, GoFood'),

                TextInput::make('url')
                    ->url()
                    ->placeholder('https://...')
                    ->helperText('Link to restaurant page on platform'),

                FileUpload::make('logo_url')
                    ->label('Platform Logo')
                    ->image()
                    ->directory('platforms')
                    ->visibility('public'),

                Textarea::make('description')
                    ->rows(3)
                    ->placeholder('Brief description of the platform'),

                TextInput::make('commission_rate')
                    ->label('Commission Rate (%)')
                    ->numeric()
                    ->suffix('%')
                    ->default(0),

                TextInput::make('sort_order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->helperText('Commission rate charged by platform'),

                TextInput::make('sort_order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }
}
