<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessInfoResource\Pages;
use App\Models\BusinessInfo;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BusinessInfoResource extends Resource
{
    protected static ?string $model = BusinessInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $recordTitleAttribute = 'business_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Business Information')
                    ->description('Core business details. Other content is managed in separate sections.')
                    ->schema([
                        TextInput::make('business_name')
                            ->label('Nama Bisnis')
                            ->required()
                            ->maxLength(150)
                            ->placeholder('e.g. Mie Ikan Laut Pedas'),

                        TextInput::make('tagline')
                            ->label('Tagline')
                            ->maxLength(255)
                            ->placeholder('e.g. Sensasi Pedas yang Menggugah Selera')
                            ->helperText('Slogan atau motto bisnis Anda'),

                        FileUpload::make('logo')
                            ->label('Logo Bisnis')
                            ->image()
                            ->directory('business/logos')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/svg+xml'])
                            ->helperText('Upload logo bisnis (JPG, PNG, atau SVG) - Max 2MB')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '2:1',
                                null
                            ])
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('300')
                            ->imageResizeTargetHeight('300'),
                    ]),

                Section::make('Content Management')
                    ->description('Other business content is managed through dedicated sections')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Placeholder::make('hero_sections')
                                    ->label('Hero Sections')
                                    ->content('Manage hero banners and promotional content in the Hero Sections resource.'),

                                Placeholder::make('about')
                                    ->label('About Information')
                                    ->content('Manage business story and about content in the About Sections resource.'),

                                Placeholder::make('contact')
                                    ->label('Contact Information')
                                    ->content('Manage phone, email, address, and maps in the Contact Info resource.'),

                                Placeholder::make('social_media')
                                    ->label('Social Media')
                                    ->content('Manage Instagram, TikTok, Facebook, and other social accounts in the Social Media resource.'),

                                Placeholder::make('delivery')
                                    ->label('Delivery Platforms')
                                    ->content('Manage GrabFood, GoFood, and other delivery platforms in the Delivery Platforms resource.'),

                                Placeholder::make('hours')
                                    ->label('Operating Hours')
                                    ->content('Manage weekly schedule and special hours in the Operating Hours resource.'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('business_name')
                    ->label('Business Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tagline')
                    ->label('Tagline')
                    ->limit(50)
                    ->searchable(),

                ImageColumn::make('logo')
                    ->label('Logo')
                    ->height(50)
                    ->width(50)
                    ->extraAttributes([
                        'style' => 'object-fit: contain; border-radius: 8px; border: 1px solid #e5e7eb;'
                    ])
                    ->defaultImageUrl(url('/images/placeholder-logo.png')),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
