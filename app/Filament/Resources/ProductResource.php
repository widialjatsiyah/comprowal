<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Detail produk')->schema([
                TextInput::make('title')->label('Nama produk')->required()->maxLength(255),
                TextInput::make('category')->label('Kategori')->placeholder('SaaS, Mobile App, Web App'),
                TextInput::make('product_url')->label('URL produk')->url()->maxLength(255),
                Textarea::make('summary')->label('Ringkasan')->rows(3),
                Textarea::make('description')->label('Deskripsi lengkap')->rows(5)->columnSpanFull(),
                FileUpload::make('image_path')->label('Gambar produk')->image()->disk('public')->directory('products')->visibility('public')->imageEditor()->columnSpanFull(),
            ])->columns(2),
            Section::make('Tampilan')->schema([
                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0)->required(),
                Toggle::make('is_featured')->label('Produk unggulan'),
                Toggle::make('is_active')->label('Tampilkan di website')->default(true),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image_path')->label('Gambar')->disk('public'),
            TextColumn::make('title')->label('Produk')->searchable()->sortable(),
            TextColumn::make('category')->label('Kategori')->badge(),
            IconColumn::make('is_featured')->label('Unggulan')->boolean(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->defaultSort('sort_order')->actions([
            EditAction::make(),
            DeleteAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
