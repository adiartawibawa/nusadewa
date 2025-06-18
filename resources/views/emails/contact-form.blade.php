@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Nusa Dewa Aquaculture
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

    @component('mail::button', [
        'url' => route('admin.contact-messages.show', $contactMessage->id),
        'color' => 'primary',
    ])
        View Message in Dashboard
    @endcomponent

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} Nusa Dewa Aquaculture. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
