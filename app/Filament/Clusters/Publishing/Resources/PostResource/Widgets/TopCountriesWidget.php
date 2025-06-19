<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use App\Models\View;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class TopCountriesWidget extends ChartWidget
{
    protected static ?string $heading = 'Top Visitor Countries';
    protected static ?string $maxHeight = '300px';
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Cache::remember('top_visitor_countries', now()->addMinutes(30), function () {
            return View::query()
                ->select('country_code')
                ->selectRaw('COUNT(*) as total')
                ->whereNotNull('country_code')
                ->groupBy('country_code')
                ->orderByDesc('total')
                ->limit(8)
                ->get();
        });

        $labels = $data->pluck('country_code')->map(
            fn($code) => function_exists('country_code_to_name') ? country_code_to_name($code) : $code
        );

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => $this->getColorPalette($data->count()),
                ],
            ],
        ];
    }

    protected function getColorPalette(int $count): array
    {
        $colors = [
            '#3b82f6',
            '#ef4444',
            '#10b981',
            '#f59e0b',
            '#8b5cf6',
            '#ec4899',
            '#14b8a6',
            '#f97316',
        ];

        return array_slice($colors, 0, $count);
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
