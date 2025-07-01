<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormSubmission;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ContactForm extends Component implements HasForms
{
    use InteractsWithForms;

    public $name;
    public $email;
    public $subject;
    public $message;
    public $success = false;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Full Name')
                ->required()
                ->minLength(3)
                ->maxLength(100),

            TextInput::make('email')
                ->label('Email Address')
                ->email()
                ->required()
                ->maxLength(100),

            TextInput::make('subject')
                ->label('Subject')
                ->required()
                ->minLength(5)
                ->maxLength(200),

            Textarea::make('message')
                ->label('Message')
                ->required()
                ->minLength(10)
                ->maxLength(2000)
                ->rows(5),
        ];
    }

    public function submit()
    {
        // Rate limiting (3 requests per minute)
        if (RateLimiter::tooManyAttempts('contact-form:' . request()->ip(), 3)) {
            $this->addError('rate_limit', 'Too many submission attempts. Please try again later.');
            return;
        }

        RateLimiter::hit('contact-form:' . request()->ip(), 60);

        try {
            $validated = $this->validate([
                'name' => 'required|min:3|max:100',
                'email' => 'required|email|max:100',
                'subject' => 'required|min:5|max:200',
                'message' => 'required|min:10|max:2000',
            ]);

            $contactMessage = ContactMessage::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip_address' => request()->ip(),
            ]);

            Mail::to(config('mail.contact_recipient', 'info@nusadewa.com'))
                ->send(new ContactFormSubmission($contactMessage));

            $this->success = true;
            $this->resetForm();
            $this->dispatch('contact-form-submitted');
        } catch (\Exception $e) {
            Log::error('Contact form submission failed: ' . $e->getMessage());
            $this->addError('submit_error', 'An error occurred while submitting your message. Please try again later.');
        }
    }

    protected function resetForm()
    {
        $this->reset(['name', 'email', 'subject', 'message']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
