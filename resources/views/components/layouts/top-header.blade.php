@php
    // Get operational hours with defaults
    $hours = $appInfo['operationalHours'] ?? [
        'monday' => ['07:30', '16:00'],
        'tuesday' => ['07:30', '16:00'],
        'wednesday' => ['07:30', '16:00'],
        'thursday' => ['07:30', '16:00'],
        'friday' => ['07:30', '16:30'],
        'saturday' => ['Closed', 'Closed'],
        'sunday' => ['Closed', 'Closed'],
    ];

    // Format weekday hours (Monday-Friday)
    $weekdayStart = $hours['monday'][0] === 'Closed' ? 'Closed' : date('g:iA', strtotime($hours['monday'][0]));
    $weekdayEnd = $hours['monday'][1] === 'Closed' ? 'Closed' : date('g:iA', strtotime($hours['monday'][1]));
    $weekdayHours = $weekdayStart === 'Closed' ? 'Closed' : $weekdayStart . ' - ' . $weekdayEnd;

    // Format weekend hours (Saturday-Sunday)
    $weekendHours =
        $hours['saturday'][0] === 'Closed'
            ? 'Closed'
            : date('g:iA', strtotime($hours['saturday'][0])) . ' - ' . date('g:iA', strtotime($hours['saturday'][1]));

    // Build the final display string
    $operatingHours = 'Monday-Friday: ' . $weekdayHours . ' Saturday-Sunday: ' . $weekendHours;
@endphp

<div class="relative z-30 hidden py-2 bg-transparent border-b border-gray-200 border-opacity-20 md:block">
    <div class="container px-4 mx-auto">
        <div class="flex flex-col items-center justify-between md:flex-row">
            <div class="flex flex-wrap justify-center gap-4 mb-2 text-xs md:justify-start md:mb-0">
                <a href="tel:{{ $appInfo['phone'] }}" class="flex items-center text-white hover:text-blue-300">
                    <i class="mr-2 fas fa-phone-alt"></i>{{ $appInfo['phone'] }}
                </a>
                <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank" rel="noopener noreferrer"
                    class="flex items-center text-white hover:text-blue-300">
                    <i class="mr-2 fas fa-map-marker-alt"></i>
                    {{ $appInfo['address'] }},
                    {{ $appInfo['city'] }},
                    {{ $appInfo['province'] }}
                    {{ $appInfo['postal_code'] }},
                    {{ $appInfo['country'] }}
                </a>
                <a href="#" class="flex items-center text-white hover:text-blue-300">
                    <i class="mr-2 far fa-clock"></i>
                    {!! $operatingHours !!}
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <div class="flex space-x-3">
                    @isset($appInfo['social_media']['facebook'])
                        <a href="{{ $appInfo['social_media']['facebook'] }}" target="_blank" rel="noopener noreferrer"
                            class="text-white hover:text-blue-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endisset

                    @isset($appInfo['social_media']['twitter'])
                        <a href="{{ $appInfo['social_media']['twitter'] }}" target="_blank" rel="noopener noreferrer"
                            class="text-white hover:text-blue-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endisset

                    @isset($appInfo['social_media']['instagram'])
                        <a href="{{ $appInfo['social_media']['instagram'] }}" target="_blank" rel="noopener noreferrer"
                            class="text-white hover:text-blue-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endisset

                    @isset($appInfo['social_media']['youtube'])
                        <a href="{{ $appInfo['social_media']['youtube'] }}" target="_blank" rel="noopener noreferrer"
                            class="text-white hover:text-red-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endisset
                </div>

                <div class="ml-2">
                    <button x-show="currentLocale === 'en'" @click="switchLocale"
                        class="text-white hover:text-blue-300 focus:outline-none" title="Switch to Bahasa Indonesia">
                        🇮🇩
                    </button>
                    <button x-show="currentLocale === 'id'" @click="switchLocale"
                        class="text-white hover:text-blue-300 focus:outline-none" title="Switch to English">
                        🇺🇸
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
