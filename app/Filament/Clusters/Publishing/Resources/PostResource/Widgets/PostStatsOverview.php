<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Reactive;

class PostStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected ?string $heading = 'Post Statistics Overview';

    #[Reactive]
    public ?string $timeRange = '7';

    protected function getStats(): array
    {
        return [
            $this->buildStatCard(
                label: 'Total Posts',
                count: Post::count(),
                query: Post::query(),
                color: 'primary'
            ),

            $this->buildStatCard(
                label: 'Published Posts',
                count: Post::published()->count(),
                query: Post::published(),
                color: 'success'
            ),

            $this->buildStatCard(
                label: 'Draft Posts',
                count: Post::draft()->count(),
                query: Post::draft(),
                color: 'warning'
            ),

            $this->buildStatCard(
                label: 'Featured Posts',
                count: Post::featured()->count(),
                query: Post::featured(),
                color: 'danger'
            ),
        ];
    }

    protected function buildStatCard(string $label, int $count, $query, string $color): Stat
    {
        $trendData = $this->getTrendData($query);

        return Stat::make($label, $count)
            ->description($this->getTrendDescription($trendData))
            ->descriptionIcon($this->getTrendIcon($trendData))
            ->chart($trendData)
            ->color($color)
            ->extraAttributes([
                'wire:click' => "\$dispatch('updateTimeRange', { stat: '{$label}' })",
                'class' => 'cursor-pointer',
            ]);
    }

    protected function getTrendData($query): array
    {
        $days = $this->getDaysFromTimeRange();
        $cacheKey = 'trend_' . md5($query->toSql() . serialize($query->getBindings())) . '_' . $days;

        return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($query, $days) {
            $startDate = now()->subDays($days - 1)->startOfDay();
            $endDate = now()->endOfDay();

            $results = Trend::query($query)
                ->between($startDate, $endDate)
                ->perDay()
                ->count();

            $data = $results->mapWithKeys(fn(TrendValue $value) => [
                $value->date => $value->aggregate
            ]);

            $filledData = [];
            for ($i = 0; $i < $days; $i++) {
                $date = $startDate->copy()->addDays($i)->format('Y-m-d');
                $filledData[] = $data[$date] ?? 0;
            }

            return $filledData;
        });
    }

    protected function getDaysFromTimeRange(): int
    {
        return match ($this->timeRange) {
            'week' => 7,
            'month' => 30,
            default => 14,
        };
    }

    protected function getTrendDescription(array $data): string
    {
        if (count($data) < 2) {
            return 'No trend data';
        }

        $latest = $data[count($data) - 1];
        $previous = $data[count($data) - 2];

        if ($previous === 0) {
            return $latest > 0 ? 'New activity' : 'No change';
        }

        $change = round((($latest - $previous) / $previous) * 100);

        return abs($change) . '% ' . ($change >= 0 ? 'increase' : 'decrease');
    }

    protected function getTrendIcon(array $data): string
    {
        if (count($data) < 2) {
            return 'heroicon-m-minus';
        }

        $latest = $data[count($data) - 1];
        $previous = $data[count($data) - 2];

        return ($latest >= $previous)
            ? 'heroicon-m-arrow-trending-up'
            : 'heroicon-m-arrow-trending-down';
    }
}
