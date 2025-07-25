<?php

namespace App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\Pages;

use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCategory extends CreateRecord
{
    protected static string $resource = ProductCategoryResource::class;
}
