<?php

namespace App\Filament\Clusters\Communications\Resources\ContactMessageResource\Pages;

use App\Filament\Clusters\Communications\Resources\ContactMessageResource;
use App\Filament\Clusters\Communications\Resources\ContactMessageResource\Widgets\ContactMessageStatsWidget;
use App\Filament\Clusters\Communications\Resources\ContactMessageResource\Widgets\LatestContactMessages;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ContactMessageStatsWidget::class,
            LatestContactMessages::class,
        ];
    }
}
