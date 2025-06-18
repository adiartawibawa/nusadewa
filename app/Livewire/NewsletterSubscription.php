<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterConfirmation;

class NewsletterSubscription extends Component
{
    public $email;
    public $success = false;

    protected $rules = [
        'email' => 'required|email|max:100|unique:newsletter_subscribers,email',
    ];

    protected $messages = [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already subscribed.',
    ];

    public function subscribe()
    {
        $this->validate();

        $subscriber = NewsletterSubscriber::create([
            'email' => $this->email,
            'ip_address' => request()->ip(),
        ]);

        // Send confirmation email
        Mail::to($this->email)->send(new NewsletterConfirmation($subscriber));

        $this->success = true;
        $this->reset('email');

        // Reset success message after 5 seconds
        $this->dispatch('reset-success');
    }

    public function render()
    {
        return view('livewire.newsletter-subscription');
    }
}
