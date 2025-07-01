<x-mail::message>
    # Test Email Configuration

    This email confirms that your email settings are working correctly.

    **Configuration Details:**
    **Mailer:** {{ $settings->mailer }}
    **Host:** {{ $settings->host ?? 'N/A' }}
    **Port:** {{ $settings->port ?? 'N/A' }}
    **Encryption:** {{ $settings->encryption ?? 'None' }}
    **From Address:** {{ $settings->from_address }}
    **From Name:** {{ $settings->from_name }}

    **Test Sent At:** {{ $time }}

    Thanks,<br>
    {{ $appInfo['company_name'] }}
</x-mail::message>
