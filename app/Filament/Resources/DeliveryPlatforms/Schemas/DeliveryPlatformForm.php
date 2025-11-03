<?php

namespace App\Filament\Resources\DeliveryPlatforms\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;

class DeliveryPlatformForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Platform Information')
                    ->schema([
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
                    ])->columns(2),

                Section::make('Business Settings')
                    ->schema([
                        TextInput::make('commission_rate')
                            ->label('Commission Rate (%)')
                            ->numeric()
                            ->suffix('%')
                            ->default(0)
                            ->helperText('Commission rate charged by platform'),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(3),

                Section::make('Contact Information')
                    ->schema([
                        Repeater::make('contact_info')
                            ->label('Contact Details')
                            ->schema([
                                TextInput::make('key')
                                    ->placeholder('e.g. phone, support_url'),
                                TextInput::make('value')
                                    ->placeholder('Contact value'),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('Add Contact Info'),
                    ]),
            ]);
    }
}
