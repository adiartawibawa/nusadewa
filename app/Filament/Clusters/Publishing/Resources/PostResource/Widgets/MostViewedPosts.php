<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use App\Enums\PostType;
use App\Filament\Clusters\Publishing\Resources\PostResource;
use App\Models\Post;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class MostViewedPosts extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\Action::make('view_all')
                ->label('View All')
                ->url(PostResource::getUrl('index'))
                ->icon('heroicon-o-arrow-right')
                ->color('primary'),
        ];
    }

    protected function getTableDescription(): ?string
    {
        return 'Top 10 most viewed posts based on visitor tracking';
    }

    protected function getTableQuery(): Builder
    {
        return Post::query()
            ->withCount('views')
            ->latest('views_count')
            ->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')
                ->label('Title')
                ->searchable()
                ->limit(50)
                ->tooltip(fn($record) => $record->title),

            TextColumn::make('type')
                ->label('Type')
                ->badge()
                ->formatStateUsing(fn(PostType $state): string => $state->value)
                ->color(fn(PostType $state): string => match ($state) {
                    PostType::ARTICLE => 'info',
                    PostType::NEWS => 'danger',
                    PostType::PAGE => 'success',
                    PostType::PRODUCT => 'warning',
                    PostType::TECHNOLOGY => 'gray',
                    default => 'blue',
                }),

            TextColumn::make('views_count')
                ->label('Views')
                ->numeric()
                ->sortable(),

            TextColumn::make('published_at')
                ->label('Published')
                ->date('M d, Y')
                ->sortable(),

            IconColumn::make('is_featured')
                ->label('Featured')
                ->boolean(),
        ];
    }
}
