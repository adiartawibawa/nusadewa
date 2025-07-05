<?php

namespace App\Filament\Clusters\Transactions\Resources\OrderResource\Pages;

use App\Filament\Clusters\Transactions\Resources\OrderResource;
use App\Filament\Clusters\Transactions\Resources\OrderResource\Widgets\OrderStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStatsWidget::class,
        ];
    }
}
