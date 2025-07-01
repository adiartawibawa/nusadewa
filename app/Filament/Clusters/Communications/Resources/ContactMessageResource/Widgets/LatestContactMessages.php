<?php

namespace App\Filament\Clusters\Communications\Resources\ContactMessageResource\Widgets;

use App\Models\ContactMessage;
use Filament\Widgets\Widget;

class LatestContactMessages extends Widget
{
    protected static string $view = 'filament.clusters.communications.resources.contact-message-resource.widgets.latest-contact-messages';

    protected static ?int $sort = 3;

    protected static ?string $pollingInterval = '30s';

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'messages' => ContactMessage::latest()->take(3)->get(),
        ];
    }
}
