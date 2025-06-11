<?php

namespace App\Filament\Clusters\Publishing\Resources;

use App\Filament\Clusters\Publishing;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\ProductCategory;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $cluster = Publishing::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('language')
                            ->options([
                                'en' => 'English',
                                'id' => 'Indonesian',
                                // tambahkan bahasa lain sesuai kebutuhan
                            ])
                            ->required(),

                        Forms\Components\Select::make('translation_group_id')
                            ->label('Translation Group')
                            ->relationship('translations', 'title')
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('type')
                            ->options([
                                'article' => 'Article',
                                'news' => 'News',
                                'page' => 'Page',
                                'blog' => 'Blog',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('summary')
                            ->maxLength(500)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('body')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('posts/attachments'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Featured Image')
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->image()
                            ->directory('posts/featured-images')
                            ->imageEditor(),

                        Forms\Components\TextInput::make('featured_image_caption')
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('Publishing')
                    ->schema([
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Publish Date'),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Post'),

                        Forms\Components\Toggle::make('is_landing_page')
                            ->label('Landing Page Post')
                            ->live(),

                        Forms\Components\TextInput::make('landing_page_section')
                            ->visible(fn(Forms\Get $get) => $get('is_landing_page'))
                            ->maxLength(255),

                        Forms\Components\TextInput::make('landing_page_order')
                            ->visible(fn(Forms\Get $get) => $get('is_landing_page'))
                            ->numeric(),

                        Forms\Components\Toggle::make('indexable')
                            ->label('Allow search engines to index this post')
                            ->default(true),
                    ]),

                Forms\Components\Section::make('Relationships')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Author')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('topics')
                            ->relationship('topics', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('productCategories')
                            ->relationship(
                                name: 'productCategories',
                                modifyQueryUsing: fn(Builder $query) => $query->orderBy('post_product_categories.order')
                            )
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ]),

                Forms\Components\Section::make('SEO & Metadata')
                    ->schema([
                        Forms\Components\KeyValue::make('meta')
                            ->keyLabel('Meta Key')
                            ->valueLabel('Meta Value'),

                        Forms\Components\KeyValue::make('seo_data')
                            ->keyLabel('SEO Key')
                            ->valueLabel('SEO Value'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Image'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'article' => 'info',
                        'news' => 'danger',
                        'page' => 'success',
                        'blog' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('read_time')
                    ->label('Read Time'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'article' => 'Article',
                        'news' => 'News',
                        'page' => 'Page',
                        'blog' => 'Blog',
                    ]),

                Tables\Filters\SelectFilter::make('language')
                    ->options([
                        'en' => 'English',
                        'id' => 'Indonesian',
                    ]),

                Tables\Filters\Filter::make('featured')
                    ->label('Featured Posts')
                    ->query(fn(Builder $query): Builder => $query->where('is_featured', true)),

                Tables\Filters\Filter::make('published')
                    ->label('Published Posts')
                    ->query(fn(Builder $query): Builder => $query->published()),

                Tables\Filters\Filter::make('draft')
                    ->label('Draft Posts')
                    ->query(fn(Builder $query): Builder => $query->draft()),

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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Anda bisa menambahkan relasi di sini jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Publishing\Resources\PostResource\Pages\ListPosts::route('/'),
            'create' => Publishing\Resources\PostResource\Pages\CreatePost::route('/create'),
            'edit' => Publishing\Resources\PostResource\Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
