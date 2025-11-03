<?php

namespace App\Filament\Resources\HeroSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeroSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('business_info_id')
                    ->relationship('businessInfo', 'id')
                    ->required(),
                FileUpload::make('image')
                    ->image(),
                Textarea::make('title')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('subtitle')
                    ->columnSpanFull(),
                TextInput::make('cta_text'),
                TextInput::make('cta_link'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
