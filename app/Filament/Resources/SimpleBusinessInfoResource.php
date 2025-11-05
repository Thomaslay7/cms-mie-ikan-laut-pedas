<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessInfoResource\Pages;
use App\Models\BusinessInfo;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class SimpleBusinessInfoResource extends Resource
{
    protected static ?string $model = BusinessInfo::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Business Info';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('business_name')
                    ->required()
                    ->maxLength(150),

                TextInput::make('tagline')
                    ->maxLength(200),

                FileUpload::make('logo')
                    ->image()
                    ->imageResizeMode('contain')
                    ->directory('business'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('business_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tagline')
                    ->limit(50),

                ImageColumn::make('logo')
                    ->size(40),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinessInfos::route('/'),
            'create' => Pages\CreateBusinessInfo::route('/create'),
            'edit' => Pages\EditBusinessInfo::route('/{record}/edit'),
        ];
    }
}
