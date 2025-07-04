<?php

namespace App\Filament\Clusters\Transactions\Resources\OrderResource\Pages;

use App\Filament\Clusters\Transactions\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
