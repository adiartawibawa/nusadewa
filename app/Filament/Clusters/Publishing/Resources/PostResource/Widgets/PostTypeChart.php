<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use App\Models\Post;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Collection;

class PostTypeChart extends ChartWidget
{
    protected static ?string $heading = 'Posts by Type';

    protected static ?string $pollingInterval = '30s';

    protected static ?string $maxHeight = '300px';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();
        $dateRange = $this->generateDateRange($start, $end);

        $types = Post::distinct()->pluck('type');
        $datasets = $types->map(fn(string $type) => $this->buildDatasetForType($type, $dateRange, $start, $end));

        return [
            'labels' => $dateRange->map(fn($date) => $date->format('M d')),
            'datasets' => $datasets->all(),
        ];
    }

    protected function buildDatasetForType(string $type, Collection $dateRange, $start, $end): array
    {
        $data = $this->getTrendDataByType($type, $start, $end);
        $filledData = $this->fillMissingDates($data, $dateRange);

        return [
            'label' => ucfirst($type),
            'data' => $filledData,
            'borderColor' => $this->getColorForType($type),
            'backgroundColor' => $this->getColorForType($type, 0.2),
            'tension' => 0.3,
        ];
    }

    protected function getTrendDataByType(string $type, $start, $end): Collection
    {
        return Trend::query(Post::where('type', $type))
            ->between($start, $end)
            ->perDay()
            ->count()
            ->mapWithKeys(fn(TrendValue $value) => [$value->date => $value->aggregate]);
    }

    protected function generateDateRange($startDate, $endDate): Collection
    {
        return collect(CarbonPeriod::create($startDate, $endDate));
    }

    protected function fillMissingDates(Collection $data, Collection $dateRange): array
    {
        return $dateRange
            ->map(fn($date) => $data[$date->format('Y-m-d')] ?? 0)
            ->toArray();
    }

    protected function getColorForType(string $type, float $opacity = 1): string
    {
        $colors = [
            'article' => [59, 130, 246],     // blue
            'news' => [239, 68, 68],         // red
            'product' => [16, 185, 129],     // green
            'page' => [139, 92, 246],        // purple
            'technology' => [245, 158, 11],  // amber
        ];

        $rgb = $colors[strtolower($type)] ?? [156, 163, 175]; // gray default

        return "rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$opacity})";
    }

    protected function getType(): string
    {
        return 'line';
    }
}
