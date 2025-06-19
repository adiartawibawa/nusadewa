<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use App\Models\View;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TrafficSourcesWidget extends ChartWidget
{
    protected static ?string $heading = 'Traffic Sources Analysis';

    protected static ?string $description = 'Distribution of traffic by source';

    protected static ?string $maxHeight = '400px';

    protected static ?string $pollingInterval = '300s'; // 5 minutes

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        return Cache::remember($this->getCacheKey(), $this->getCacheDuration(), function () {
            $sources = $this->getTrafficSourcesData();

            return [
                'labels' => $sources->keys(),
                'datasets' => [
                    [
                        'data' => $sources->values(),
                        'backgroundColor' => $this->getBackgroundColors($sources),
                        'hoverBackgroundColor' => $this->getHoverColors($sources),
                        'borderWidth' => 1,
                        'borderColor' => '#fff',
                    ],
                ],
            ];
        });
    }

    protected function getTrafficSourcesData(): \Illuminate\Support\Collection
    {
        return DB::table('views')
            ->selectRaw("
                CASE
                    WHEN referer IS NULL THEN 'Direct'
                    WHEN referer LIKE '%google.%' THEN 'Google'
                    WHEN referer LIKE '%facebook.%' THEN 'Facebook'
                    ELSE 'Other Referrals'
                END AS source,
                COUNT(*) as count
            ")
            ->groupBy('source')
            ->orderByDesc('count')
            ->limit(8) // Limit to top 8 sources
            ->get()
            ->pluck('count', 'source');
    }

    protected function getBackgroundColors(\Illuminate\Support\Collection $sources): array
    {
        $colorMap = [
            'Direct' => '#3b82f6', // blue
            'Google' => '#10b981', // emerald
            'Facebook' => '#2563eb', // facebook blue
            'Other Referrals' => '#f59e0b', // amber
            'Twitter' => '#1da1f2', // twitter blue
            'Instagram' => '#e1306c', // instagram pink
            'LinkedIn' => '#0a66c2', // linkedin blue
            'YouTube' => '#ff0000', // youtube red
        ];

        return $sources->keys()->map(
            fn($source) => $colorMap[$source] ?? $this->generateColor($source)
        )->toArray();
    }

    protected function getHoverColors(\Illuminate\Support\Collection $sources): array
    {
        return collect($this->getBackgroundColors($sources))
            ->map(fn($color) => $this->darkenColor($color, 0.2))
            ->toArray();
    }

    protected function generateColor(string $source): string
    {
        // Generate consistent color based on source name
        $hash = md5($source);
        return sprintf("#%s", substr($hash, 0, 6));
    }

    protected function darkenColor(string $hex, float $percent): string
    {
        $rgb = sscanf($hex, "#%02x%02x%02x");
        $darkened = array_map(
            fn($c) => max(0, min(255, $c * (1 - $percent))),
            $rgb
        );
        return sprintf("#%02x%02x%02x", ...$darkened);
    }

    protected function getCacheKey(): string
    {
        return 'traffic_sources_' . now()->format('Y-m-d');
    }

    protected function getCacheDuration()
    {
        return now()->addHours(2); // Cache for 2 hours
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'cutout' => '70%',
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                    'labels' => [
                        'boxWidth' => 12,
                        'padding' => 20,
                        'usePointStyle' => true,
                    ],
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => function ($context) {
                            $label = $context->label;
                            $value = $context->raw;
                            $total = array_sum($context->chart->data->datasets[0]->data);
                            $percentage = round(($value / $total) * 100, 2);
                            return "$label: $value ($percentage%)";
                        }
                    ]
                ],
            ],
        ];
    }
}
