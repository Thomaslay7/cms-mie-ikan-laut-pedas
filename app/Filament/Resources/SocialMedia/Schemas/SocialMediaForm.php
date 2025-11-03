<?php

namespace App\Filament\Resources\SocialMedia\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SocialMediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('business_info_id')
                    ->relationship('businessInfo', 'id')
                    ->required(),
                TextInput::make('platform')
                    ->required(),
                TextInput::make('url')
                    ->url()
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
