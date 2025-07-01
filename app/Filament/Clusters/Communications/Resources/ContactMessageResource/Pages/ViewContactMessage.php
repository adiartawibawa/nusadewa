<?php

namespace App\Filament\Clusters\Communications\Resources\ContactMessageResource\Pages;

use App\Filament\Clusters\Communications\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageReplyMail;

class ViewContactMessage extends Page
{
    protected static string $resource = ContactMessageResource::class;
    protected static string $view = 'filament.clusters.communications.resources.contact-message-resource.pages.view-contact-message';
    protected static ?string $title = 'View Message';

    public ContactMessage $record;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('reply')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->form([
                    \Filament\Forms\Components\Textarea::make('message')
                        ->required()
                        ->label('Reply Message')
                        ->columnSpanFull(),
                ])
                ->action(function (array $data) {
                    // Simpan balasan ke database
                    $reply = $this->record->replies()->create([
                        'message' => $data['message'],
                    ]);

                    // Update status sudah dibaca
                    $this->record->update(['is_read' => true]);

                    // Kirim email balasan
                    try {
                        Mail::to($this->record->email)
                            ->send(new ContactMessageReplyMail(
                                $this->record,
                                $data['message']
                            ));

                        Notification::make()
                            ->title('Reply Sent Successfully')
                            ->body('Your reply has been sent to ' . $this->record->email)
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Failed to Send Email')
                            ->body('Error: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
