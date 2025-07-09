@props([
    'appInfo' => null,
])

<footer class="pt-12 pb-6 text-white bg-gray-900">
    <div class="container px-4 mx-auto">
        <div class="flex flex-col items-center justify-between pb-6 mb-6 border-b border-gray-700 md:flex-row">
            <div class="mb-4 md:mb-0">
                <img src="{{ $appInfo['companyLogo'] }}" alt="{{ $appInfo['company_name'] }} Logo" class="h-10">
            </div>
            <div class="flex flex-wrap justify-center gap-4 text-sm">
                @foreach (__('app.footer.navigation') as $item)
                    <a href="#{{ $item['url'] }}" class="transition-colors hover:text-primary">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-4">
            <div>
                <h5 class="mb-3 text-base font-semibold">{{ __('app.footer.headings.headquarters') }}</h5>
                <p class="text-sm text-gray-400">{{ $appInfo['company_name'] }}<br>
                    {{ $appInfo['address'] }}<br>
                    {{ $appInfo['city'] }}, {{ $appInfo['province'] }}
                    {{ $appInfo['postal_code'] }}</p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">{{ __('app.footer.headings.contact_us') }}</h5>
                <p class="mb-1 text-sm text-gray-400">{{ $appInfo['phone'] }}</p>
                <p class="text-sm text-gray-400">info@nusadewa.com<br>
                    sales@nusadewa.com</p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">{{ __('app.footer.headings.business_hours') }}</h5>
                <p class="text-sm text-gray-400">
                    {!! $appInfo['formattedHours'] !!}
                </p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">{{ __('app.footer.headings.newsletter') }}</h5>
                <livewire:newsletter-subscription />
            </div>
        </div>

        <div class="flex flex-col items-center justify-between pt-4 border-t border-gray-700 md:flex-row">
            <p class="mb-3 text-xs text-gray-400 md:mb-0">&copy; {{ date('Y') }}
                {{ $appInfo['company_name'] }}. {{ __('app.footer.copyright') }}</p>
            <div class="flex items-center space-x-4">
                <div href="#" class="text-xs text-gray-400">
                    {{ __('app.footer.made_by') }} <a href="https://wa.me/+6281918175060" target="_blank"
                        class="text-primary hover:underline">
                        PRADStudio
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
