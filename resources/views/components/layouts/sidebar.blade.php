@props([
    'appInfo' => null,
])

<div x-show="sidebarOpen" @click.away="sidebarOpen = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
    class="fixed inset-y-0 right-0 z-50 overflow-y-auto bg-white shadow-xl w-80">
    <div class="p-6">
        <button @click="sidebarOpen = false"
            class="absolute text-gray-500 top-4 right-4 hover:text-gray-700 focus:outline-none">
            <i class="text-xl fas fa-times"></i>
        </button>

        <div class="mt-16 space-y-8">
            <div>
                <h3 class="mb-4 text-xl font-bold">Quick Contact Info</h3>
                <p class="text-sm text-gray-600">
                    {{ $appInfo['company_description'] }}
                </p>
            </div>

            <div>
                <h5 class="font-bold text-gray-800">CONTACT</h5>
                <a href="tel:{{ $appInfo['phone'] }}" class="text-sm font-semibold text-blue-600 hover:underline">
                    {{ $appInfo['phone'] ? preg_replace('/(\d{2})(\d{3})(\d{4})/', '$1-$2-$3', $appInfo['phone']) : '0363-278-7803' }}
                </a>
                <a href="mailto:{{ $appInfo['email'] }}" class="block text-sm text-gray-600 hover:underline">
                    {{ $appInfo['email'] }}
                </a>
            </div>

            <div>
                <h5 class="font-bold text-gray-800">OFFICE</h5>
                <a href="https://maps.google.com?q={{ urlencode($appInfo['address']) }}" target="_blank"
                    rel="noopener noreferrer" class="text-sm text-gray-600 hover:underline">
                    {{ $appInfo['address'] }}<br>
                    {{ $appInfo['city'] }}, {{ $appInfo['province'] }}<br>
                    {{ $appInfo['postal_code'] }}
                </a>
            </div>

            <div>
                <h5 class="font-bold text-gray-800">OPENING HOURS</h5>
                <p class="text-sm text-gray-600">
                    {!! $appInfo['formattedHours'] !!}
                </p>
            </div>
        </div>
    </div>
</div>
