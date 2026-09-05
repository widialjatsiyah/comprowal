<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class VisitorStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->subDays(6)->startOfDay();

        return [
            Stat::make('Total kunjungan', Visit::query()->count())
                ->description('Semua page view yang tercatat')
                ->color('primary'),
            Stat::make('Pengunjung hari ini', Visit::query()->where('visited_at', '>=', $today)->distinct('visitor_hash')->count('visitor_hash'))
                ->description('Pengunjung unik hari ini')
                ->color('success'),
            Stat::make('7 hari terakhir', Visit::query()->where('visited_at', '>=', $weekStart)->distinct('visitor_hash')->count('visitor_hash'))
                ->description('Pengunjung unik')
                ->color('info'),
        ];
    }
}
