<?php

namespace App\Filament\Clusters\Transactions\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Collection;

class OrderStatsWidget extends BaseWidget
{
    protected ?string $heading = 'Order Statistics Overview';

    protected function getStats(): array
    {
        // Weekly order trend data (last 6 weeks)
        $orderTrend = Trend::model(Order::class)
            ->between(now()->subWeeks(6), now())
            ->perWeek()
            ->count();

        // Get all required counts in single queries
        $todayOrders = Order::whereDate('created_at', today())->count();
        $upcomingDeliveries = Order::where('delivery_date', '>=', now())->count();
        $pastDueDeliveries = Order::where('delivery_date', '<', now())->count();

        return [
            // Total Orders with trend chart
            Stat::make('Total Orders', Order::count())
                ->icon('heroicon-o-shopping-bag')
                ->chart($orderTrend->map(fn(TrendValue $value) => $value->aggregate)->toArray())
                ->description($this->getTrendDescription($orderTrend))
                ->color('primary'),

            // Today's Orders
            Stat::make("Today's Orders", $todayOrders)
                ->icon('heroicon-o-calendar-days')
                ->description($this->getDailyComparison($todayOrders))
                ->color($todayOrders > 0 ? 'success' : 'gray'),

            // Upcoming Deliveries
            Stat::make('Upcoming Deliveries', $upcomingDeliveries)
                ->icon('heroicon-o-clock')
                ->description($this->getDeliveryTrend('upcoming'))
                ->color('info'),

            // Past Due Deliveries
            Stat::make('Past Due Deliveries', $pastDueDeliveries)
                ->icon('heroicon-o-exclamation-triangle')
                ->description($pastDueDeliveries > 0 ? 'Needs attention' : 'All on track')
                ->color($pastDueDeliveries > 0 ? 'danger' : 'success'),
        ];
    }

    protected function getTrendDescription(Collection $trendData): string
    {
        if ($trendData->count() < 2) return 'Insufficient data for trend';

        $current = $trendData->last()->aggregate;
        $previous = $trendData->get($trendData->count() - 2)->aggregate;

        if ($previous === 0) return 'New tracking period';

        $change = (($current - $previous) / $previous) * 100;
        $trend = $change >= 0 ? 'increase' : 'decrease';

        return abs(round($change)) . '% ' . $trend . ' from last week';
    }

    protected function getDailyComparison(int $todayCount): string
    {
        $yesterdayCount = Order::whereDate('created_at', today()->subDay())->count();

        if ($yesterdayCount === 0) return $todayCount > 0 ? 'First orders today' : 'No orders yet';

        $change = (($todayCount - $yesterdayCount) / $yesterdayCount) * 100;
        $trend = $change >= 0 ? 'increase' : 'decrease';

        return abs(round($change)) . '% ' . $trend . ' from yesterday';
    }

    protected function getDeliveryTrend(string $type): string
    {
        $currentCount = Order::where('delivery_date', $type === 'upcoming' ? '>=' : '<', now())->count();
        $previousCount = Order::where('delivery_date', $type === 'upcoming' ? '>=' : '<', now()->subWeek())
            ->where('delivery_date', $type === 'upcoming' ? '<' : '>=', now())
            ->count();

        if ($previousCount === 0) return $currentCount > 0 ? 'New ' . $type . ' deliveries' : 'No deliveries';

        $change = (($currentCount - $previousCount) / $previousCount) * 100;
        $trend = $change >= 0 ? 'more' : 'less';

        return abs(round($change)) . '% ' . $trend . ' than last week';
    }
}
