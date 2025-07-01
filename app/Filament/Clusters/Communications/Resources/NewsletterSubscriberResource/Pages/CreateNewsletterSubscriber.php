<?php

namespace App\Filament\Clusters\Communications\Resources\NewsletterSubscriberResource\Pages;

use App\Filament\Clusters\Communications\Resources\NewsletterSubscriberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsletterSubscriber extends CreateRecord
{
    protected static string $resource = NewsletterSubscriberResource::class;
}
