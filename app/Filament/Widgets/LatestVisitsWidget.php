<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestVisitsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Aktivitas Kunjungan Terakhir';

    public function table(Table $table): Table
    {
        return $table
            ->query(Visit::query()->latest('visited_at'))
            ->columns([
                TextColumn::make('ip')->label('IP Address')->searchable(),
                TextColumn::make('path')->label('Halaman')->badge(),
                TextColumn::make('user_agent')->label('User Agent')->limit(40)->tooltip(fn ($record) => $record->user_agent),
                TextColumn::make('visited_at')->label('Waktu')->dateTime('d M Y, H:i')->sortable(),
            ])
            ->filters([
                Filter::make('visited_at')
                    ->form([
                        DatePicker::make('from')->label('Dari Tanggal'),
                        DatePicker::make('until')->label('Sampai Tanggal'),
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
                    }),
            ])
            ->paginated([5, 10, 25]);
    }
}
