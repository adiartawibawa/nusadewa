@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ $appInfo['company_name'] }}
        @endcomponent
    @endslot

    {{-- Body --}}
    # Thank You for Subscribing!

    We're excited to have you on board!
    You'll receive updates on our latest research, products, and news about vannamei broodstock.

    @component('mail::button', ['url' => route('newsletter.confirm', $subscriber->unsubscribe_token)])
        Confirm Subscription
    @endcomponent

    If you didn't request this subscription, you can safely ignore this email.

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ $appInfo['company_name'] }}. All rights reserved.
            [Unsubscribe]({{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }})
        @endcomponent
    @endslot
@endcomponent
