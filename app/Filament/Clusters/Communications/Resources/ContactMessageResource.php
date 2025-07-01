<?php

namespace App\Filament\Clusters\Communications\Resources;

use App\Filament\Clusters\Communications;
use App\Filament\Clusters\Communications\Resources\ContactMessageResource\Pages;
use App\Filament\Clusters\Communications\Resources\ContactMessageResource\RelationManagers;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = Communications::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('ip_address')
                    ->maxLength(45),
                Forms\Components\Section::make('Admin Reply')
                    ->schema([
                        Forms\Components\Repeater::make('replies')
                            ->relationship()
                            ->schema([
                                Forms\Components\Textarea::make('message')
                                    ->required()
                                    ->label('Reply Message')
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(1)
                            ->addActionLabel('Add Another Reply')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Toggle::make('is_read')
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean(),
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
                Tables\Filters\Filter::make('unread')
                    ->query(fn(Builder $query): Builder => $query->where('is_read', false))
                    ->label('Unread Messages'),
                Tables\Filters\Filter::make('no_replies')
                    ->query(fn(Builder $query): Builder => $query->doesntHave('replies'))
                    ->label('Unanswered Messages'),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('reply')
                    ->form([
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->label('Reply Message'),
                    ])
                    ->action(function (ContactMessage $record, array $data) {
                        $record->replies()->create([
                            'message' => $data['message'],
                        ]);
                        $record->update(['is_read' => true]);
                    })
                    ->icon('heroicon-o-chat-bubble-left-right'),
                Tables\Actions\Action::make('markAsRead')
                    ->action(function (ContactMessage $record) {
                        $record->update(['is_read' => true]);
                    })
                    ->icon('heroicon-o-check')
                    ->hidden(fn(ContactMessage $record) => $record->is_read),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->action(function (Collection $records) {
                            $records->each->update(['is_read' => true]);
                        })
                        ->icon('heroicon-o-check')
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
