<?php

namespace App\Filament\Resources\MenuItems;

use App\Filament\Resources\MenuItems\Pages\ManageMenuItems;
use App\Models\MenuItem;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Gambar Menu')
                    ->image()
                    ->directory('menu-items')
                    ->imageEditor(),

                \Filament\Forms\Components\Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('name')
                    ->label('Nama Menu')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->maxLength(1000),
                \Filament\Forms\Components\Textarea::make('short_description')
                    ->label('Deskripsi Singkat')
                    ->maxLength(255),
                TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                TextInput::make('original_price')
                    ->label('Harga Asli')
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('preparation_time')
                    ->label('Waktu Persiapan (menit)')
                    ->numeric(),
                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Unggulan')
                    ->default(false),
                \Filament\Forms\Components\Toggle::make('is_available')
                    ->label('Tersedia')
                    ->default(true),
                \Filament\Forms\Components\Toggle::make('is_popular')
                    ->label('Populer')
                    ->default(false),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->size(60)
                    ->square(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Menu')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('preparation_time')
                    ->label('Waktu Persiapan')
                    ->suffix(' menit')
                    ->sortable(),
                \Filament\Tables\Columns\BooleanColumn::make('is_available')
                    ->label('Tersedia'),
                \Filament\Tables\Columns\BooleanColumn::make('is_featured')
                    ->label('Unggulan'),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
                \Filament\Tables\Filters\Filter::make('available')
                    ->label('Hanya Tersedia')
                    ->query(fn ($query) => $query->where('is_available', true)),
                \Filament\Tables\Filters\Filter::make('featured')
                    ->label('Hanya Unggulan')
                    ->query(fn ($query) => $query->where('is_featured', true)),
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
            'index' => ManageMenuItems::route('/'),
        ];
    }
}
