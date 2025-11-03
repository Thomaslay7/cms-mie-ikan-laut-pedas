<?php

namespace App\Filament\Resources\FAQS;

use App\Filament\Resources\FAQS\Pages\ManageFAQS;
use App\Models\FAQ;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Table;

class FAQResource extends Resource
{
    protected static ?string $model = FAQ::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'question';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Textarea::make('question')
                    ->label('Pertanyaan')
                    ->required()
                    ->maxLength(500),
                \Filament\Forms\Components\Textarea::make('answer')
                    ->label('Jawaban')
                    ->required()
                    ->maxLength(1000),
                \Filament\Forms\Components\Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'menu' => 'Menu',
                        'delivery' => 'Pengiriman',
                        'payment' => 'Pembayaran',
                        'general' => 'Umum',
                    ])
                    ->default('general'),
                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Unggulan')
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
            ->recordTitleAttribute('question')
            ->columns([
                TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge(),
                \Filament\Tables\Columns\BooleanColumn::make('is_featured')
                    ->label('Unggulan'),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
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
            'index' => ManageFAQS::route('/'),
        ];
    }
}
