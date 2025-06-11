<?php

namespace App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\Pages;

use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductCategory extends ViewRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
