<?php

namespace App\Filament\Clusters\Communications\Resources\NewsletterSubscriberResource\Pages;

use App\Filament\Clusters\Communications\Resources\NewsletterSubscriberResource;
use App\Filament\Clusters\Communications\Resources\NewsletterSubscriberResource\Widgets\NewsletterSubscriberStats;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsletterSubscribers extends ListRecords
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            NewsletterSubscriberStats::class,
        ];
    }
}
