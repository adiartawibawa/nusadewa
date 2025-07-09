@props([
    'appInfo' => null,
])

<div x-show="sidebarOpen" @click.away="sidebarOpen = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
    class="fixed inset-y-0 right-0 z-50 w-full max-w-xs overflow-y-auto bg-white shadow-xl dark:bg-gray-800"
    aria-modal="true" role="dialog" aria-label="{{ __('app.sidebar.title') }}">

    <div class="p-6">
        <button @click="sidebarOpen = false"
            class="absolute p-2 text-gray-500 transition-colors rounded-full top-4 right-4 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            aria-label="{{ __('Close sidebar') }}">
            <i class="text-xl fas fa-times"></i>
        </button>

        <div class="mt-16 space-y-8">
            <!-- Company Description -->
            <div>
                <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('app.sidebar.title') }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    {{ $appInfo['company_description'] }}
                </p>
            </div>

            <!-- Contact Info -->
            <div>
                <h5 class="font-bold text-gray-800 dark:text-gray-200">
                    {{ __('app.sidebar.sections.contact') }}
                </h5>
                <a href="tel:{{ $appInfo['phone'] }}"
                    class="block text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                    {{ $appInfo['phone'] ? preg_replace('/(\d{2})(\d{3})(\d{4})/', '$1-$2-$3', $appInfo['phone']) : '0363-278-7803' }}
                </a>
                <a href="mailto:{{ $appInfo['email'] }}"
                    class="block mt-1 text-sm text-gray-600 dark:text-gray-400 hover:underline">
                    {{ $appInfo['email'] }}
                </a>
            </div>

            <!-- Office Address -->
            <div>
                <h5 class="font-bold text-gray-800 dark:text-gray-200">
                    {{ __('app.sidebar.sections.office') }}
                </h5>
                <a href="https://maps.google.com?q={{ urlencode($appInfo['address']) }}" target="_blank"
                    rel="noopener noreferrer"
                    class="block mt-1 text-sm text-gray-600 dark:text-gray-400 hover:underline">
                    {{ $appInfo['address'] }}<br>
                    {{ $appInfo['city'] }}, {{ $appInfo['province'] }}<br>
                    {{ $appInfo['postal_code'] }}
                </a>
            </div>

            <!-- Opening Hours -->
            <div>
                <h5 class="font-bold text-gray-800 dark:text-gray-200">
                    {{ __('app.sidebar.sections.hours') }}
                </h5>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {!! $appInfo['formattedHours'] !!}
                </div>
            </div>

            <!-- Social Media Links -->
            @if (isset($appInfo['social_links']))
                <div>
                    <h5 class="font-bold text-gray-800 dark:text-gray-200">
                        {{ __('app.sidebar.sections.follow') }}
                    </h5>
                    <div class="flex mt-2 space-x-4">
                        @foreach ($appInfo['social_links'] as $social)
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                class="p-2 text-gray-600 transition-colors rounded-full dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700"
                                aria-label="{{ __('app.sidebar.social_labels.' . $social['platform']) }}">
                                <i class="{{ $social['icon_class'] }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
