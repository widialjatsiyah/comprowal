<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'Komunikasi';
    protected static ?string $navigationLabel = 'Pesan Kontak';
    protected static ?string $modelLabel = 'Pesan Kontak';
    protected static ?string $pluralModelLabel = 'Pesan Kontak';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label('Nama')->disabled(),
            TextInput::make('email')->label('Email')->disabled(),
            TextInput::make('phone')->label('Telepon')->disabled(),
            Select::make('status')->label('Status')->options(['new' => 'Baru', 'read' => 'Dibaca', 'replied' => 'Sudah dibalas'])->required(),
            Textarea::make('message')->label('Pesan')->rows(8)->disabled()->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Nama')->searchable()->sortable(),
            TextColumn::make('email')->label('Email')->searchable(),
            TextColumn::make('message')->label('Pesan')->limit(60),
            TextColumn::make('status')->label('Status')->badge()->colors(['warning' => 'new', 'info' => 'read', 'success' => 'replied']),
            TextColumn::make('created_at')->label('Masuk')->dateTime('d M Y, H:i')->sortable(),
        ])->defaultSort('created_at', 'desc')->actions([
            \Filament\Tables\Actions\EditAction::make(),
            \Filament\Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListContactMessages::route('/'), 'edit' => Pages\EditContactMessage::route('/{record}/edit')];
    }
}
