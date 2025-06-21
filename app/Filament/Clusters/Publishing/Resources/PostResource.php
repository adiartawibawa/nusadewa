<?php

namespace App\Filament\Clusters\Publishing\Resources;

use App\Enums\PostType;
use App\Filament\Clusters\Publishing;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\ProductCategory;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
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
                            ->live(onBlur: true),

                        Forms\Components\Select::make('language')
                            ->options([
                                'en' => 'English',
                                'id' => 'Indonesian',
                            ])
                            ->required(),

                        Forms\Components\Select::make('type')
                            ->options([
                                'article' => 'Article',
                                'news' => 'News',
                                'page' => 'Page',
                                'product' => 'Product',
                                'technology' => 'Technology',
                            ])
                            ->required()
                            ->live(),

                        Select::make('productCategories')
                            ->relationship('productCategories', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->hidden(fn(Get $get): bool => $get('type') !== 'product')
                            ->required(fn(Get $get): bool => $get('type') === 'product')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->createOptionUsing(function (array $data): string {
                                return \App\Models\ProductCategory::create([
                                    'name' => $data['name'],
                                    'user_id' => auth()->id(),
                                ])->id;
                            }),

                        Forms\Components\Textarea::make('summary')
                            ->maxLength(500)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('body')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('posts/attachments'),

                        Forms\Components\Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([ // Form untuk membuat tag baru
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->createOptionUsing(function (array $data) { // Logic penyimpanan
                                return \App\Models\Tag::create([
                                    'name' => $data['name'],
                                    'user_id' => auth()->id(),
                                ])->id;
                            }),

                        Forms\Components\Select::make('topics')
                            ->relationship('topics', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return \App\Models\Topic::create([
                                    'name' => $data['name'],
                                    'user_id' => auth()->id(),
                                ])->id;
                            }),
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

                        // Forms\Components\Toggle::make('is_landing_page')
                        //     ->label('Landing Page Post')
                        //     ->live(),

                        // Forms\Components\TextInput::make('landing_page_section')
                        //     ->visible(fn(Forms\Get $get) => $get('is_landing_page'))
                        //     ->maxLength(255),

                        // Forms\Components\TextInput::make('landing_page_order')
                        //     ->visible(fn(Forms\Get $get) => $get('is_landing_page'))
                        //     ->numeric(),

                        Forms\Components\Toggle::make('indexable')
                            ->label('Allow search engines to index this post')
                            ->default(true),
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
                    ->formatStateUsing(fn(PostType $state): string => $state->value)
                    ->color(fn(PostType $state): string => match ($state) {
                        PostType::ARTICLE => 'info',
                        PostType::NEWS => 'danger',
                        PostType::PAGE => 'success',
                        PostType::PRODUCT => 'warning',
                        PostType::TECHNOLOGY => 'gray',
                        default => 'blue',
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
                        'product' => 'Product',
                        'technology' => 'Technology',
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
