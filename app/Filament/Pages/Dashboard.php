<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Communications\Resources\ContactMessageResource\Widgets\LatestContactMessages;
use App\Filament\Clusters\Publishing\Resources\PostResource\Widgets\{
    LatestPostsTable,
    MostViewedPosts,
    PostStatsOverview,
    PostTypeChart,
    PostViewsStats,
    PostViewsTrend,
    TrafficSourcesWidget
};
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function getNavigationLabel(): string
    {
        return __('Dashboard');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PostStatsOverview::class,
            LatestPostsTable::class,
            LatestContactMessages::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            PostTypeChart::class,
            PostViewsStats::class,
            MostViewedPosts::class,
            PostViewsTrend::class,
            TrafficSourcesWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 4,
            'xl' => 6,
        ];
    }

    public function getHeaderWidgetsColumns(): int | string | array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 2,
            'xl' => 2,
        ];
    }

    protected function getColumnSpan(int | string | array $widget): int | string | array
    {
        return match ($widget) {
            PostStatsOverview::class, LatestPostsTable::class => 'full',
            PostTypeChart::class => 'full',
            PostViewsTrend::class, TrafficSourcesWidget::class => 'full',
            default => 1,
        };
    }

    public function getTitle(): string
    {
        return 'Content Performance Dashboard';
    }
}
