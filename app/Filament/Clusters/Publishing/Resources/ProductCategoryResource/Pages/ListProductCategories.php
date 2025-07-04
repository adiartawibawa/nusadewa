<?php

namespace App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\Pages;

use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
