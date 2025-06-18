<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;
    public $success = false;

    protected $rules = [
        'name' => 'required|min:3|max:100',
        'email' => 'required|email|max:100',
        'subject' => 'required|min:5|max:200',
        'message' => 'required|min:10|max:2000',
    ];

    public function submit()
    {
        $this->validate();

        // Create contact message
        $contactMessage = ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'ip_address' => request()->ip(),
        ]);

        // Send email notification
        Mail::to('info@nusadewa.com')->send(new ContactFormSubmission($contactMessage));

        // Show success message and reset form
        $this->success = true;
        $this->reset(['name', 'email', 'subject', 'message']);

        // Reset success message after 5 seconds
        $this->dispatch('reset-success');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
