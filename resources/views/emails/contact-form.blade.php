@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        {{ $appInfo['company_name'] }}
        @endcomponent
    @endslot

    # New Contact Form Submission

    **Name:** {{ $contactMessage->name }}
    **Email:** {{ $contactMessage->email }}
    **Subject:** {{ $contactMessage->subject }}
    **IP Address:** {{ $contactMessage->ip_address }}
    **Date:** {{ $contactMessage->created_at->format('F j, Y \a\t g:i a') }}

    ### Message:
    {{ $contactMessage->message }}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ $appInfo['company_name'] }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
