<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use App\Models\View;
use Filament\Widgets\ChartWidget;

class TopCountriesWidget extends ChartWidget
{
    protected static ?string $heading = 'Top Visitor Countries';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = View::query()
            ->select('country_code')
            ->selectRaw('count(*) as total')
            ->whereNotNull('country_code')
            ->groupBy('country_code')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return [
            'labels' => $data->pluck('country_code')->map(fn($code) => country_code_to_name($code)),
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => ['#3b82f6', '#ef4444', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#14b8a6', '#f97316'],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
