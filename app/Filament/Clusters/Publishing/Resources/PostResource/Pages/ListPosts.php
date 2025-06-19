<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Pages;

use App\Filament\Clusters\Publishing\Resources\PostResource;
use App\Filament\Clusters\Publishing\Resources\PostResource\Widgets\PostStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PostStatsOverview::class,
        ];
    }
}
