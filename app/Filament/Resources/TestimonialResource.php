<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Testimonial';
    protected static ?string $modelLabel = 'Testimonial';
    protected static ?string $pluralModelLabel = 'Testimonial';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Testimonial klien')->schema([
                TextInput::make('client_name')->label('Nama klien')->required()->maxLength(255),
                TextInput::make('client_role')->label('Jabatan')->maxLength(255),
                TextInput::make('company')->label('Perusahaan')->maxLength(255),
                Textarea::make('quote')->label('Testimonial')->required()->rows(5)->columnSpanFull(),
            ])->columns(3),
            Section::make('Tampilan')->schema([
                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0)->required(),
                Toggle::make('is_active')->label('Tampilkan di website')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('client_name')->label('Nama klien')->searchable()->sortable(),
            TextColumn::make('company')->label('Perusahaan')->placeholder('-'),
            TextColumn::make('quote')->label('Testimonial')->limit(65),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->defaultSort('sort_order')->actions([
            \Filament\Tables\Actions\EditAction::make(),
            \Filament\Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListTestimonials::route('/'), 'create' => Pages\CreateTestimonial::route('/create'), 'edit' => Pages\EditTestimonial::route('/{record}/edit')];
    }
}
