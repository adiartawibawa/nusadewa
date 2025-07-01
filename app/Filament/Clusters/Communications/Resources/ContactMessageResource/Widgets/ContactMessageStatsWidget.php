<?php

namespace App\Filament\Clusters\Communications\Resources\ContactMessageResource\Widgets;

use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ContactMessageStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $unreadCount = ContactMessage::where('is_read', false)->count();
        $repliedCount = DB::table('contact_message_replies')
            ->select(DB::raw('COUNT(DISTINCT contact_message_id) as count'))
            ->value('count');

        $latestMessages = ContactMessage::latest()
            ->take(3)
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'name' => $message->name,
                    'email' => $message->email,
                    'subject' => $message->subject,
                    'time' => $message->created_at->diffForHumans(),
                    'is_read' => $message->is_read,
                ];
            });

        return [
            Stat::make('Total Messages', ContactMessage::count())
                ->icon('heroicon-o-envelope')
                ->description('All contact messages received')
                ->chart([7, 3, 4, 5, 6, 3, 5])
                ->color('primary'),

            Stat::make('Unread Messages', $unreadCount)
                ->icon('heroicon-o-eye-slash')
                ->description('Require attention')
                ->chart([2, 1, 3, 1, 0, 2, 1])
                ->color($unreadCount > 0 ? 'danger' : 'success'),

            Stat::make('Replied Messages', $repliedCount)
                ->icon('heroicon-o-check-circle')
                ->description('Messages with responses')
                ->chart([1, 2, 3, 2, 4, 3, 2])
                ->color('success'),

            Stat::make('Latest Messages', '')
                ->view('filament.clusters.communications.resources.contact-message-resource.widgets.latest-messages', [
                    'messages' => $latestMessages,
                ]),
        ];
    }
}
