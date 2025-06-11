<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'System Management';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $modelLabel = 'User';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profile Information')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatars')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull()
                            ->helperText('Upload a profile picture for this user'),

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('username')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->maxLength(255)
                            ->dehydrated(fn(?string $state): bool => filled($state))
                            ->same('passwordConfirmation'),

                        Forms\Components\TextInput::make('passwordConfirmation')
                            ->password()
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->maxLength(255)
                            ->dehydrated(false),

                        Forms\Components\Textarea::make('summary')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Select::make('locale')
                            ->options([
                                'en' => 'English',
                                'id' => 'Indonesian',
                            ]),

                        Forms\Components\Select::make('role')
                            ->options([
                                User::CONTRIBUTOR => 'Contributor',
                                User::EDITOR => 'Editor',
                                User::ADMIN => 'Admin',
                            ])
                            ->required(),

                        Forms\Components\Toggle::make('dark_mode')
                            ->label('Dark Mode'),

                        Forms\Components\Toggle::make('digest')
                            ->label('Email Digest'),

                        Forms\Components\Toggle::make('is_team_member')
                            ->label('Team Member')
                            ->live(),

                        Forms\Components\TextInput::make('position')
                            ->maxLength(255)
                            ->visible(fn(Forms\Get $get): bool => $get('is_team_member')),
                    ])->columns(2),

                Forms\Components\Section::make('Social Links')
                    ->schema([
                        Forms\Components\KeyValue::make('social_links')
                            ->keyLabel('Platform')
                            ->valueLabel('URL')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->formatStateUsing(fn(int $state): string => match ($state) {
                        User::CONTRIBUTOR => 'Contributor',
                        User::EDITOR => 'Editor',
                        User::ADMIN => 'Admin',
                        default => 'Unknown',
                    })
                    ->color(fn(int $state): string => match ($state) {
                        User::CONTRIBUTOR => 'info',
                        User::EDITOR => 'warning',
                        User::ADMIN => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_team_member')
                    ->label('Team')
                    ->boolean(),

                Tables\Columns\TextColumn::make('position')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        User::CONTRIBUTOR => 'Contributor',
                        User::EDITOR => 'Editor',
                        User::ADMIN => 'Admin',
                    ]),

                Tables\Filters\Filter::make('team_members')
                    ->label('Team Members')
                    ->query(fn(Builder $query): Builder => $query->where('is_team_member', true)),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
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
            // Tambahkan relation managers jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
