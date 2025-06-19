<?php

namespace App\Filament\Clusters\Publishing\Resources;

use App\Filament\Clusters\Publishing;
use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\Pages\CreateProductCategory;
use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\Pages\EditProductCategory;
use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\Pages\ListProductCategories;
use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\Pages\ViewProductCategory;
use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\RelationManagers\PostsRelationManager;
use App\Filament\Clusters\Publishing\Resources\ProductCategoryResource\RelationManagers\SubcategoriesRelationManager;
use App\Models\ProductCategory;
use App\Models\Post;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $cluster = Publishing::class;

    protected static ?string $navigationGroup = 'Products';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Category';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Category Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('parent_id')
                            ->label('Parent Category')
                            ->options(
                                fn() => ProductCategory::mainCategories()->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Forms\Components\FileUpload::make('icon')
                            ->image()
                            ->directory('product-categories/icons')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('SEO Data')
                    ->schema([
                        Forms\Components\KeyValue::make('seo_data')
                            ->keyLabel('Meta Key')
                            ->valueLabel('Meta Value')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Relationships')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Created By')
                            ->options(
                                fn() => User::query()->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('posts')
                            ->relationship('posts', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Icon'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Parent Category')
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('posts_count')
                    ->label('Posts')
                    ->counts('posts'),

                Tables\Columns\TextColumn::make('children_count')
                    ->label('Subcategories')
                    ->counts('children'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label('Parent Category')
                    ->options(ProductCategory::mainCategories()->pluck('name', 'id')),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            SubcategoriesRelationManager::class,
            PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductCategories::route('/'),
            'create' => CreateProductCategory::route('/create'),
            'view' => ViewProductCategory::route('/{record}'),
            'edit' => EditProductCategory::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['parent', 'children'])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
