<?php

namespace App\Filament\Clusters\Communications\Resources\NewsletterSubscriberResource\Pages;

use App\Filament\Clusters\Communications\Resources\NewsletterSubscriberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsletterSubscriber extends EditRecord
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
