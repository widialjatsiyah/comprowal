<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanySettingResource\Pages;
use App\Models\CompanySetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompanySettingResource extends Resource
{
    protected static ?string $model = CompanySetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Profil Perusahaan';

    protected static ?string $modelLabel = 'Profil Perusahaan';

    protected static ?string $pluralModelLabel = 'Profil Perusahaan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Identitas utama')
                ->description('Informasi ini tampil di halaman publik perusahaan.')
                ->schema([
                    TextInput::make('company_name')
                        ->label('Nama perusahaan')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('tagline')
                        ->label('Tagline')
                        ->placeholder('Teknologi yang membuat bisnis bergerak')
                        ->maxLength(255),
                    FileUpload::make('logo_path')
                        ->label('Logo perusahaan')
                        ->image()
                        ->disk('public')
                        ->directory('branding')
                        ->visibility('public')
                        ->imageEditor(),
                    Textarea::make('description')
                        ->label('Deskripsi singkat')
                        ->rows(5)
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Section::make('Kontak')
                ->schema([
                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->label('Telepon')
                        ->maxLength(50),
                    TextInput::make('address')
                        ->label('Alamat')
                        ->maxLength(255)
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Section::make('SEO website')
                ->description('Pengaturan ini dipakai untuk judul, deskripsi, dan preview saat dibagikan ke mesin pencari atau media sosial.')
                ->schema([
                    TextInput::make('seo_title')
                        ->label('SEO title')
                        ->maxLength(255)
                        ->helperText('Idealnya maksimal sekitar 60 karakter.'),
                    TextInput::make('seo_keywords')
                        ->label('Kata kunci')
                        ->maxLength(255)
                        ->helperText('Pisahkan dengan koma.'),
                    Textarea::make('seo_description')
                        ->label('SEO description')
                        ->rows(3)
                        ->maxLength(160)
                        ->columnSpanFull()
                        ->helperText('Idealnya maksimal sekitar 160 karakter.'),
                    FileUpload::make('seo_image')
                        ->label('Gambar preview sosial')
                        ->image()
                        ->disk('public')
                        ->directory('branding')
                        ->visibility('public')
                        ->imageEditor()
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name')->label('Nama perusahaan')->searchable(),
                TextColumn::make('email')->label('Email')->placeholder('-'),
                TextColumn::make('updated_at')->label('Terakhir diperbarui')->dateTime('d M Y, H:i'),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanySettings::route('/'),
            'create' => Pages\CreateCompanySetting::route('/create'),
            'edit' => Pages\EditCompanySetting::route('/{record}/edit'),
        ];
    }
}
