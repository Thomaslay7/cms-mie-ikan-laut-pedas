<?php

namespace App\Filament\Resources\ChefInfos;

use App\Filament\Resources\ChefInfos\Pages\ManageChefInfos;
use App\Models\ChefInfo;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class ChefInfoResource extends Resource
{
    protected static ?string $model = ChefInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar')
                    ->label('Foto Chef')
                    ->image()
                    ->directory('chefs')
                    ->imageEditor()
                    ->circleCropper(),

                TextInput::make('name')
                    ->label('Nama Chef')
                    ->required()
                    ->maxLength(100),
                TextInput::make('title')
                    ->label('Posisi')
                    ->maxLength(100),
                \Filament\Forms\Components\Textarea::make('bio')
                    ->label('Biografi')
                    ->maxLength(1000),
                TextInput::make('experience_years')
                    ->label('Pengalaman (Tahun)')
                    ->numeric()
                    ->minValue(0),
                TextInput::make('speciality')
                    ->label('Spesialisasi')
                    ->maxLength(100),
                \Filament\Forms\Components\Toggle::make('is_head_chef')
                    ->label('Kepala Chef')
                    ->default(false),
                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Unggulan')
                    ->default(true),
                TextInput::make('social_instagram')
                    ->label('Instagram')
                    ->url()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->size(60),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Posisi'),
                TextColumn::make('experience_years')
                    ->label('Pengalaman')
                    ->suffix(' tahun'),
                \Filament\Tables\Columns\BooleanColumn::make('is_head_chef')
                    ->label('Kepala Chef'),
                \Filament\Tables\Columns\BooleanColumn::make('is_featured')
                    ->label('Unggulan'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageChefInfos::route('/'),
        ];
    }
}
