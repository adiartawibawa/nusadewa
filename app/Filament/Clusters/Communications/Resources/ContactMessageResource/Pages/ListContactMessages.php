<?php

namespace App\Filament\Clusters\Communications\Resources\ContactMessageResource\Pages;

use App\Filament\Clusters\Communications\Resources\ContactMessageResource;
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
}
