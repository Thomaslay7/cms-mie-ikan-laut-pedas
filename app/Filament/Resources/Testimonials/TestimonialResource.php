<?php

namespace App\Filament\Resources\Testimonials;

use App\Filament\Resources\Testimonials\Pages\ManageTestimonials;
use App\Models\Testimonial;
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

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $recordTitleAttribute = 'customer_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->required()
                    ->maxLength(100),
                TextInput::make('customer_location')
                    ->label('Lokasi Pelanggan')
                    ->maxLength(100),
                TextInput::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(5),
                \Filament\Forms\Components\Textarea::make('review_text')
                    ->label('Review')
                    ->required()
                    ->maxLength(1000),
                \Filament\Forms\Components\Select::make('platform')
                    ->label('Platform')
                    ->options([
                        'google' => 'Google',
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'direct' => 'Langsung',
                    ])
                    ->default('direct'),
                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Unggulan')
                    ->default(false),
                \Filament\Forms\Components\Toggle::make('is_approved')
                    ->label('Disetujui')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('customer_name')
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable(),
                TextColumn::make('review_text')
                    ->label('Review')
                    ->limit(50),
                TextColumn::make('platform')
                    ->label('Platform')
                    ->badge(),
                \Filament\Tables\Columns\BooleanColumn::make('is_featured')
                    ->label('Unggulan'),
                \Filament\Tables\Columns\BooleanColumn::make('is_approved')
                    ->label('Disetujui'),
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
            'index' => ManageTestimonials::route('/'),
        ];
    }
}
