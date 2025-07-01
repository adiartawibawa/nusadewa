<?php

namespace App\Filament\Clusters\Communications\Resources\ContactMessageResource\Pages;

use App\Filament\Clusters\Communications\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContactMessage extends CreateRecord
{
    protected static string $resource = ContactMessageResource::class;
}
