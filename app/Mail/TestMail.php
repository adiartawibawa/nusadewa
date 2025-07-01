<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Settings\EmailSettings;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailSettings;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->emailSettings = app(EmailSettings::class);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Email Configuration - ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.test',
            with: [
                'settings' => $this->emailSettings,
                'time' => now()->format('Y-m-d H:i:s')
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
