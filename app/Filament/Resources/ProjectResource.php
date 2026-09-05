<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Portofolio';
    protected static ?string $modelLabel = 'Portofolio';
    protected static ?string $pluralModelLabel = 'Portofolio';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Detail proyek')->schema([
                TextInput::make('title')->label('Nama proyek')->required()->maxLength(255),
                TextInput::make('client')->label('Klien')->maxLength(255),
                TextInput::make('category')->label('Kategori')->placeholder('Website, Mobile App, Branding'),
                TextInput::make('project_url')->label('URL proyek')->url()->maxLength(255),
                Textarea::make('summary')->label('Ringkasan')->rows(4)->columnSpanFull(),
                Select::make('media_type')
                    ->label('Jenis media')
                    ->options([
                        'image' => 'Gambar proyek',
                        'logo' => 'Logo perusahaan',
                    ])
                    ->helperText('Logo akan otomatis ditampilkan utuh tanpa terpotong di layout.' )
                    ->default('image')
                    ->required(),
                FileUpload::make('image_path')->label('Gambar proyek')->image()->disk('public')->directory('projects')->visibility('public')->imageEditor()->columnSpanFull(),
            ])->columns(2),
            Section::make('Tampilan')->schema([
                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0)->required(),
                Toggle::make('is_featured')->label('Proyek unggulan'),
                Toggle::make('is_active')->label('Tampilkan di website')->default(true),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image_path')->label('Gambar')->disk('public'),
            TextColumn::make('title')->label('Proyek')->searchable()->sortable(),
            TextColumn::make('client')->label('Klien')->placeholder('-'),
            TextColumn::make('category')->label('Kategori')->badge(),
            TextColumn::make('media_type')->label('Jenis')->formatStateUsing(fn (string $state): string => $state === 'logo' ? 'Logo' : 'Gambar'),
            IconColumn::make('is_featured')->label('Unggulan')->boolean(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->defaultSort('sort_order')->actions([
            \Filament\Tables\Actions\EditAction::make(),
            \Filament\Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListProjects::route('/'), 'create' => Pages\CreateProject::route('/create'), 'edit' => Pages\EditProject::route('/{record}/edit')];
    }
}
