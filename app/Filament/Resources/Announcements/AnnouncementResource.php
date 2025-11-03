<?php

namespace App\Filament\Resources\Announcements;

use App\Filament\Resources\Announcements\Pages\ManageAnnouncements;
use App\Models\Announcement;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Table;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(150),
                \Filament\Forms\Components\Textarea::make('content')
                    ->label('Konten')
                    ->required()
                    ->maxLength(1000),
                \Filament\Forms\Components\Select::make('type')
                    ->label('Tipe')
                    ->options([
                        'popup' => 'Popup',
                        'banner' => 'Banner',
                        'notification' => 'Notifikasi',
                    ])
                    ->required(),
                TextInput::make('cta_text')
                    ->label('Teks CTA')
                    ->maxLength(100),
                TextInput::make('cta_link')
                    ->label('Link CTA')
                    ->url(),
                \Filament\Forms\Components\DateTimePicker::make('start_date')
                    ->label('Tanggal Mulai'),
                \Filament\Forms\Components\DateTimePicker::make('end_date')
                    ->label('Tanggal Selesai'),
                \Filament\Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge(),
                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->dateTime(),
                TextColumn::make('end_date')
                    ->label('Selesai')
                    ->dateTime(),
                \Filament\Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Aktif'),
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
            'index' => ManageAnnouncements::route('/'),
        ];
    }
}
