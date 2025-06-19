<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use App\Models\View;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Collection;

class PostViewsStats extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $trendData = $this->getViewTrend();
        $topCountry = $this->getTopCountry();

        return [
            Stat::make('Total Views', View::count())
                ->icon('heroicon-o-eye')
                ->description('All-time page views')
                ->chart($trendData)
                ->color('success'),

            Stat::make('Unique Visitors', View::distinct('ip')->count('ip'))
                ->icon('heroicon-o-user-group')
                ->description('Based on unique IPs')
                ->color('info'),

            Stat::make('Top Country', $topCountry)
                ->icon('heroicon-o-globe-alt')
                ->description('Most frequent visitors')
                ->color('warning'),
        ];
    }

    protected function getViewTrend(): array
    {
        $start = now()->subDays(6)->startOfDay(); // 7 hari termasuk hari ini
        $end = now()->endOfDay();

        return Trend::query(View::query())
            ->between($start, $end)
            ->perDay()
            ->count()
            ->map(fn(TrendValue $value) => $value->aggregate ?? 0)
            ->toArray();
    }

    protected function getTopCountry(): string
    {
        return View::select('country_code')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('country_code')
            ->orderByDesc('total')
            ->limit(1)
            ->value('country_code') ?? 'N/A';
    }
}
