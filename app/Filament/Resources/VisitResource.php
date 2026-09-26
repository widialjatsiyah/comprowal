<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use App\Models\Visit;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Analitik';

    protected static ?string $navigationLabel = 'Log Kunjungan';

    protected static ?string $modelLabel = 'Kunjungan';

    protected static ?string $pluralModelLabel = 'Kunjungan';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ip')->label('IP Address')->searchable()->sortable(),
                TextColumn::make('path')->label('Halaman')->searchable()->sortable(),
                TextColumn::make('user_agent')->label('User Agent')->limit(50)->tooltip(fn ($record) => $record->user_agent),
                TextColumn::make('visited_at')->label('Waktu')->dateTime('d M Y, H:i')->sortable(),
            ])
            ->filters([
                Filter::make('visited_at')
                    ->form([
                        DatePicker::make('from')->label('Dari tanggal'),
                        DatePicker::make('until')->label('Sampai tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('visited_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('visited_at', '<=', $date),
                            );
                    })
            ])
            ->defaultSort('visited_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVisits::route('/'),
        ];
    }
}
