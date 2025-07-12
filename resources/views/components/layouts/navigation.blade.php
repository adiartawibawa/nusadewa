@php
    $isDesktop = $type === 'desktop';
@endphp

@if ($isDesktop)
    <!-- Desktop Menu -->
    <nav class="items-center hidden space-x-8 md:flex">
        @foreach ($menuItems as $key => $item)
            @if (!$item['children'])
                <a href="{{ $item['route'] }}"
                    class="text-sm font-medium text-white transition-colors hover:text-primary">
                    {{ $item['label'] }}
                </a>
            @else
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center text-sm font-medium text-white transition-colors hover:text-primary">
                        {{ $item['label'] }} <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                            :class="{ 'transform rotate-180': open }"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-0 z-50 w-56 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                        @foreach ($item['children'] as $child)
                            <a href="{{ $child['url'] ?? '#' }}"
                                class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">
                                {{ $child['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Additional Desktop Elements -->
        <button @click="darkMode = !darkMode" class="ml-4 text-white transition-colors hover:text-primary">
            <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
            </svg>
            <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
        </button>
    </nav>
@else
    <!-- Mobile Menu -->
    <div class="space-y-4 sm:space-y-6">
        @foreach ($menuItems as $key => $item)
            @if (!$item['children'])
                <a href="{{ $item['route'] }}"
                    class="block pb-3 text-sm font-medium text-gray-800 transition-colors border-b border-gray-100 sm:pb-4 dark:border-gray-700 sm:text-base dark:text-gray-100 hover:text-primary">
                    {{ $item['label'] }}
                </a>
            @else
                <div x-data="{ open: false }" class="pb-3 border-b border-gray-100 sm:pb-4 dark:border-gray-700">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors sm:text-base dark:text-gray-100 hover:text-primary">
                        {{ $item['label'] }} <i class="ml-2 text-xs transition-transform sm:text-sm fas fa-chevron-down"
                            :class="{ 'transform rotate-180': open }"></i>
                    </button>
                    <div x-show="open" class="pl-3 mt-2 space-y-2 sm:pl-4 sm:space-y-3">
                        @foreach ($item['children'] as $child)
                            <a href="{{ $child['url'] ?? '#' }}"
                                class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">
                                {{ $child['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Additional Mobile Elements -->
        <div class="pt-6 border-t border-gray-200 sm:pt-8 dark:border-gray-700">
            <div class="space-y-3 sm:space-y-4">
                <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank"
                    class="flex items-center text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">
                    <i class="mr-2 sm:mr-3 fas fa-map-marker-alt"></i>
                    {{ $appInfo['address'] }}, {{ $appInfo['city'] }} — {{ $appInfo['province'] }}
                    {{ $appInfo['postal_code'] }}, {{ $appInfo['country'] }}
                </a>
                <a href="tel:{{ $appInfo['phone'] }}"
                    class="flex items-center text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">
                    <i class="mr-2 sm:mr-3 fas fa-phone-alt"></i> {{ $appInfo['phone'] }}
                </a>
                <div class="flex items-center text-xs text-gray-600 sm:text-sm dark:text-gray-300">
                    <i class="mr-2 sm:mr-3 far fa-clock"></i>
                    {!! $appInfo['formattedHours'] !!}
                </div>
            </div>

            <div class="flex mt-4 space-x-3 sm:mt-6 sm:space-x-4">
                @foreach ($socialMedia['social_media'] as $platform => $url)
                    @if ($url)
                        <a href="{{ $url }}" target="_blank"
                            class="text-gray-600 dark:text-gray-300 hover:text-{{ $platform == 'youtube' ? 'red' : 'blue' }}-600">
                            <i class="text-base sm:text-lg fab fa-{{ $platform }}"></i>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
