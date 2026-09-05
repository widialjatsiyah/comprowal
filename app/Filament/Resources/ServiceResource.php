<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Layanan';
    protected static ?string $modelLabel = 'Layanan';
    protected static ?string $pluralModelLabel = 'Layanan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi layanan')->schema([
                TextInput::make('title')->label('Nama layanan')->required()->maxLength(255),
                TextInput::make('icon')->label('Ikon Heroicon')->placeholder('heroicon-o-code-bracket'),
                TextInput::make('summary')->label('Ringkasan')->required()->maxLength(255)->columnSpanFull(),
                Textarea::make('description')->label('Deskripsi')->rows(5)->columnSpanFull(),
            ])->columns(2),
            Section::make('Tampilan')->schema([
                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0)->required(),
                Toggle::make('is_active')->label('Tampilkan di website')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('sort_order')->label('#')->sortable(),
            TextColumn::make('title')->label('Layanan')->searchable()->sortable(),
            TextColumn::make('summary')->label('Ringkasan')->limit(55),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->defaultSort('sort_order')->actions([
            \Filament\Tables\Actions\EditAction::make(),
            \Filament\Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListServices::route('/'), 'create' => Pages\CreateService::route('/create'), 'edit' => Pages\EditService::route('/{record}/edit')];
    }
}
