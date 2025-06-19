<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\View;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;

class PostViewsTrend extends ChartWidget
{
    protected static ?string $heading = 'Views Traffic Analysis';

    protected static ?string $maxHeight = '400px';

    protected static ?string $pollingInterval = '30s';

    protected int|string|array $columnSpan = 'full';

    #[Reactive]
    public ?string $timeRange = '30';

    protected function getData(): array
    {
        $cacheKey = $this->getCacheKey();

        return Cache::remember($cacheKey, now()->addMinutes(30), function () {
            $days = $this->getDaysFromRange();
            $dateRange = $this->generateDateRange($days);

            return [
                'labels' => $dateRange->map(fn($date) => $this->formatLabel($date)),
                'datasets' => [
                    $this->buildDataset(
                        label: 'Total Views',
                        data: $this->getTotalViews($dateRange),
                        color: '#3b82f6',
                        fill: true
                    ),
                    $this->buildDataset(
                        label: 'Unique Visitors',
                        data: $this->getUniqueVisitors($dateRange),
                        color: '#10b981',
                        fill: false
                    ),
                ],
            ];
        });
    }

    protected function buildDataset(string $label, array $data, string $color, bool $fill = false): array
    {
        return [
            'label' => $label,
            'data' => $data,
            'borderColor' => $color,
            'backgroundColor' => $fill ? $this->hexToRgba($color, 0.1) : 'transparent',
            'borderWidth' => 2,
            'pointRadius' => 4,
            'pointHoverRadius' => 6,
            'pointBackgroundColor' => '#ffffff',
            'tension' => 0.3,
            'fill' => $fill,
        ];
    }

    protected function getTotalViews($dateRange): array
    {
        $start = optional($dateRange->first())->startOfDay();
        $end = optional($dateRange->last())->endOfDay();

        $results = Trend::query(View::query())
            ->between($start, $end)
            ->perDay()
            ->count();

        return $this->mapResultsToDates($results, $dateRange);
    }

    protected function getUniqueVisitors($dateRange): array
    {
        $start = optional($dateRange->first())->format('Y-m-d');
        $end = optional($dateRange->last())->format('Y-m-d');

        $results = DB::table('views')
            ->selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip) as count')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $this->mapResultsToDates($results, $dateRange, 'date', 'count');
    }

    protected function mapResultsToDates($results, $dateRange, string $dateKey = 'date', string $valueKey = 'aggregate'): array
    {
        $mapped = collect($results)->mapWithKeys(fn($item) => [
            Carbon::parse($item->{$dateKey})->format('Y-m-d') => $item->{$valueKey}
        ]);

        return $dateRange->map(fn($date) => $mapped[$date->format('Y-m-d')] ?? 0)->toArray();
    }

    protected function generateDateRange(int $days)
    {
        $start = now()->subDays($days - 1)->startOfDay();
        $end = now()->endOfDay();

        return collect(CarbonPeriod::create($start, $end));
    }

    protected function getDaysFromRange(): int
    {
        return match ($this->timeRange) {
            '7' => 7,
            '30' => 30,
            '90' => 90,
            '180' => 180,
            default => 30,
        };
    }

    protected function formatLabel(Carbon $date): string
    {
        return $date->format($this->timeRange === '7' ? 'D, M j' : 'M j');
    }

    protected function hexToRgba(string $hex, float $alpha): string
    {
        [$r, $g, $b] = sscanf($hex, "#%02x%02x%02x");
        return "rgba($r, $g, $b, $alpha)";
    }

    protected function getCacheKey(): string
    {
        return 'views_trend_' . $this->timeRange . '_' . now()->format('Y-m-d');
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
                'zoom' => [
                    'zoom' => [
                        'wheel' => ['enabled' => true],
                        'pinch' => ['enabled' => true],
                        'mode' => 'xy',
                    ],
                    'pan' => [
                        'enabled' => true,
                        'mode' => 'xy',
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            '7' => 'Last Week',
            '30' => 'Last Month',
            '90' => 'Last Quarter',
            '180' => 'Last 6 Months',
        ];
    }
}
