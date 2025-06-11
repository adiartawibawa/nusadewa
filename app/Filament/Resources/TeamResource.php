<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages\CreateTeam;
use App\Filament\Resources\TeamResource\Pages\EditTeam;
use App\Filament\Resources\TeamResource\Pages\ListTeams;
use App\Models\TeamMember;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TeamResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = 'Team Member';

    protected static ?string $navigationGroup = 'Team Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\FileUpload::make('avatar')
                            ->image()
                            ->directory('team/avatars')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('position')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('language')
                            ->options([
                                'en' => 'English',
                                'id' => 'Indonesian',
                                // tambahkan bahasa lain sesuai kebutuhan
                            ])
                            ->required(),

                        Forms\Components\Select::make('translation_group_id')
                            ->label('Translation Group')
                            ->relationship('translations', 'name')
                            ->searchable()
                            ->preload(),

                        Forms\Components\Textarea::make('bio')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Member')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Social Links')
                    ->schema([
                        Forms\Components\KeyValue::make('social_links')
                            ->keyLabel('Platform')
                            ->valueLabel('URL')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Skills')
                    ->schema([
                        Forms\Components\TagsInput::make('skills')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('User Account')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Linked User Account')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Photo')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->label('Order'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('language')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'en' => 'info',
                        'id' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Account')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('language')
                    ->options([
                        'en' => 'English',
                        'id' => 'Indonesian',
                    ]),

                Tables\Filters\Filter::make('active')
                    ->label('Active Members')
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true)),

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
            // Anda bisa menambahkan relasi di sini jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'edit' => EditTeam::route('/{record}/edit'),
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
