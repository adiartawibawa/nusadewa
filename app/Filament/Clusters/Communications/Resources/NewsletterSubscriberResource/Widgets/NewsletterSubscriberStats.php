<?php

namespace App\Filament\Clusters\Communications\Resources\NewsletterSubscriberResource\Widgets;

use App\Models\NewsletterSubscriber;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class NewsletterSubscriberStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCount = NewsletterSubscriber::count();
        $activeCount = NewsletterSubscriber::where('is_active', true)->count();
        $verifiedCount = NewsletterSubscriber::whereNotNull('email_verified_at')->count();
        $newThisWeek = NewsletterSubscriber::where('created_at', '>=', now()->subWeek())->count();

        return [
            Stat::make('Total Subscribers', $totalCount)
                ->icon('heroicon-o-user-group')
                ->description($newThisWeek . ' new this week')
                ->descriptionIcon($newThisWeek > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart($this->getSubscriptionTrend())
                ->color($newThisWeek > 0 ? 'success' : 'danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-shadow',
                    'wire:click' => "dispatch('setStatusFilter', { filter: null })",
                ]),

            Stat::make('Active Subscribers', $activeCount)
                ->icon('heroicon-o-check-badge')
                ->description(round(($activeCount / max($totalCount, 1)) * 100) . '% of total')
                ->descriptionIcon($activeCount > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart($this->getActiveTrend())
                ->color($activeCount > 0 ? 'success' : 'danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-shadow',
                    'wire:click' => "dispatch('setStatusFilter', { filter: 'active' })",
                ]),

            Stat::make('Verified Subscribers', $verifiedCount)
                ->icon('heroicon-o-shield-check')
                ->description(round(($verifiedCount / max($totalCount, 1)) * 100) . '% of total')
                ->descriptionIcon($verifiedCount > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart($this->getVerifiedTrend())
                ->color($verifiedCount > 0 ? 'success' : 'primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-shadow',
                    'wire:click' => "dispatch('setStatusFilter', { filter: 'verified' })",
                ]),

            // Stat::make('Latest Subscribers', '')
            //     ->view('filament.clusters.communications.resources.newsletter-subscriber-resource.widgets.latest-subscribers', [
            //         'subscribers' => NewsletterSubscriber::latest()
            //             ->take(5)
            //             ->get()
            //     ])
        ];
    }

    protected function getSubscriptionTrend(): array
    {
        return NewsletterSubscriber::query()
            ->select(DB::raw('COUNT(*) as count'), DB::raw('DATE(created_at) as date'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();
    }

    protected function getActiveTrend(): array
    {
        return NewsletterSubscriber::query()
            ->select(DB::raw('COUNT(*) as count'), DB::raw('DATE(created_at) as date'))
            ->where('is_active', true)
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();
    }

    protected function getVerifiedTrend(): array
    {
        return NewsletterSubscriber::query()
            ->select(DB::raw('COUNT(*) as count'), DB::raw('DATE(created_at) as date'))
            ->whereNotNull('email_verified_at')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();
    }
}
