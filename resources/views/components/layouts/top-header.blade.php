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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
                            <path d="M31,8c0-2.209-1.791-4-4-4H5c-2.209,0-4,1.791-4,4v9H31V8Z" fill="#ea3323"></path>
                            <path d="M5,28H27c2.209,0,4-1.791,4-4v-8H1v8c0,2.209,1.791,4,4,4Z" fill="#fff"></path>
                            <path
                                d="M5,28H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4ZM2,8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8Z"
                                opacity=".15"></path>
                            <path
                                d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z"
                                fill="#fff" opacity=".2"></path>
                        </svg>
                    </button>
                    <button x-show="currentLocale === 'id'" @click="switchLocale"
                        class="text-white hover:text-blue-300 focus:outline-none" title="Switch to English">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
                            <rect x="1" y="4" width="30" height="24" rx="4" ry="4"
                                fill="#071b65"></rect>
                            <path
                                d="M5.101,4h-.101c-1.981,0-3.615,1.444-3.933,3.334L26.899,28h.101c1.981,0,3.615-1.444,3.933-3.334L5.101,4Z"
                                fill="#fff"></path>
                            <path d="M22.25,19h-2.5l9.934,7.947c.387-.353,.704-.777,.929-1.257l-8.363-6.691Z"
                                fill="#b92932"></path>
                            <path d="M1.387,6.309l8.363,6.691h2.5L2.316,5.053c-.387,.353-.704,.777-.929,1.257Z"
                                fill="#b92932"></path>
                            <path
                                d="M5,28h.101L30.933,7.334c-.318-1.891-1.952-3.334-3.933-3.334h-.101L1.067,24.666c.318,1.891,1.952,3.334,3.933,3.334Z"
                                fill="#fff"></path>
                            <rect x="13" y="4" width="6" height="24" fill="#fff"></rect>
                            <rect x="1" y="13" width="30" height="6" fill="#fff"></rect>
                            <rect x="14" y="4" width="4" height="24" fill="#b92932"></rect>
                            <rect x="14" y="1" width="4" height="30" transform="translate(32) rotate(90)"
                                fill="#b92932"></rect>
                            <path d="M28.222,4.21l-9.222,7.376v1.414h.75l9.943-7.94c-.419-.384-.918-.671-1.471-.85Z"
                                fill="#b92932"></path>
                            <path d="M2.328,26.957c.414,.374,.904,.656,1.447,.832l9.225-7.38v-1.408h-.75L2.328,26.957Z"
                                fill="#b92932"></path>
                            <path
                                d="M27,4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4Zm3,20c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24Z"
                                opacity=".15"></path>
                            <path
                                d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z"
                                fill="#fff" opacity=".2"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
