<?php

namespace App\Filament\Clusters\Communications\Resources\ContactMessageResource\Widgets;

use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ContactMessageStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalMessages = ContactMessage::count();
        $unreadCount = ContactMessage::where('is_read', false)->count();
        $repliedCount = $this->getRepliedMessageCount();

        return [
            Stat::make('Total Messages', $totalMessages)
                ->icon('heroicon-o-envelope')
                ->description('All contact messages received')
                ->chart($this->getMessageTrend('weekly'))
                ->color('primary')
                ->chartColor('primary')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->extraAttributes(['class' => 'cursor-pointer']),

            Stat::make('Unread Messages', $unreadCount)
                ->icon('heroicon-o-eye-slash')
                ->description($unreadCount > 0 ? 'Require attention' : 'All caught up')
                ->chart($this->getMessageTrend('daily'))
                ->color($unreadCount > 0 ? 'danger' : 'success')
                ->chartColor($unreadCount > 0 ? 'danger' : 'success')
                ->descriptionIcon($unreadCount > 0 ? 'heroicon-m-exclamation-circle' : 'heroicon-m-check-circle')
                ->extraAttributes(['class' => 'cursor-pointer']),

            Stat::make('Replied Messages', $repliedCount)
                ->icon('heroicon-o-check-circle')
                ->description($this->getReplyRate($totalMessages, $repliedCount))
                ->chart($this->getReplyTrend())
                ->color('success')
                ->chartColor('success')
                ->descriptionIcon('heroicon-m-chat-bubble-left-ellipsis')
                ->extraAttributes(['class' => 'cursor-pointer']),
        ];
    }

    protected function getMessageTrend(string $interval = 'daily'): array
    {
        return match ($interval) {
            'weekly' => $this->buildTrend(ContactMessage::query(), 'week'),
            default => $this->buildTrend(ContactMessage::query(), 'day'),
        };
    }

    protected function buildTrend($query, string $type = 'day'): array
    {
        $start = $type === 'week' ? now()->subWeeks(6)->startOfWeek() : now()->subDays(6)->startOfDay();
        $end = now()->endOfDay();

        $trend = Trend::query($query->clone())
            ->between($start, $end);

        $trend = $type === 'week' ? $trend->perWeek() : $trend->perDay();

        return $trend->count()
            ->map(fn(TrendValue $value) => $value->aggregate ?? 0)
            ->toArray();
    }

    protected function getReplyTrend(): array
    {
        $start = now()->subDays(6)->startOfDay();
        $end = now()->endOfDay();

        return Trend::query(ContactMessageReply::query()
            ->whereBetween('created_at', [$start, $end]))
            ->between($start, $end)
            ->perDay()
            ->count()
            ->map(fn(TrendValue $value) => $value->aggregate ?? 0)
            ->toArray();
    }

    protected function getRepliedMessageCount(): int
    {
        return ContactMessageReply::query()
            ->distinct('contact_message_id')
            ->count('contact_message_id');
    }

    protected function getReplyRate(int $total, int $replied): string
    {
        if ($total === 0) {
            return 'No messages yet';
        }

        $rate = ($replied / $total) * 100;
        return round($rate, 1) . '% reply rate';
    }
}
