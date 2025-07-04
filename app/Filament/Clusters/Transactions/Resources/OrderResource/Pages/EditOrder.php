<?php

namespace App\Filament\Clusters\Transactions\Resources\OrderResource\Pages;

use App\Filament\Clusters\Transactions\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
