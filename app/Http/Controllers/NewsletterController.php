<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function confirm($token)
    {
        $subscriber = NewsletterSubscriber::where('unsubscribe_token', $token)->firstOrFail();

        if (!$subscriber->email_verified_at) {
            $subscriber->update([
                'email_verified_at' => now(),
                'is_active' => true
            ]);

            return view('newsletter.confirmed');
        }

        return redirect('/')->with('message', 'Your subscription was already confirmed.');
    }

    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('unsubscribe_token', $token)->firstOrFail();

        $subscriber->update(['is_active' => false]);
        $subscriber->delete();

        return view('newsletter.unsubscribed');
    }
}
