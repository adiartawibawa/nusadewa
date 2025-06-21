<?php

namespace App\Filament\Clusters\Publishing\Resources\PostResource\Widgets;

use App\Enums\PostType;
use App\Models\Post;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestPostsTable extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Post::query()
            ->with(['user', 'productCategories'])
            ->latest('published_at')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            ImageColumn::make('featured_image')
                ->label('Image')
                ->circular(),

            TextColumn::make('title')
                ->searchable()
                ->limit(50),

            TextColumn::make('type')
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

            TextColumn::make('productCategories.name')
                ->badge()
                ->separator(','),

            TextColumn::make('published_at')
                ->dateTime()
                ->sortable(),

            IconColumn::make('is_featured')
                ->boolean()
                ->trueIcon('heroicon-o-star')
                ->falseIcon('heroicon-o-x-mark'),

            TextColumn::make('user.name')
                ->label('Author'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ];
    }
}
