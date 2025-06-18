@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Nusa Dewa Aquaculture
        @endcomponent
    @endslot

    # Thank You for Subscribing!

    We're excited to have you on board! You'll receive updates on our latest research, products, and news about vannamei
    broodstock.

    @component('mail::button', ['url' => route('newsletter.confirm', $subscriber->unsubscribe_token)])
        Confirm Subscription
    @endcomponent

    If you didn't request this subscription, you can safely ignore this email.

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Nusa Dewa Aquaculture. All rights reserved.<br>
            [Unsubscribe]({{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }})
        @endcomponent
    @endslot
@endcomponent
