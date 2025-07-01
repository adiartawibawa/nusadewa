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
                <a href="{{ route('home') }}" class="transition-colors hover:text-primary">Home</a>
                <a href="#" class="transition-colors hover:text-primary">About Us</a>
                <a href="#" class="transition-colors hover:text-primary">Our Products</a>
                <a href="#" class="transition-colors hover:text-primary">Research</a>
                <a href="#" class="transition-colors hover:text-primary">News</a>
                <a href="#" class="transition-colors hover:text-primary">Contact</a>
            </div>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-4">
            <div>
                <h5 class="mb-3 text-base font-semibold">HEADQUARTERS</h5>
                <p class="text-sm text-gray-400">{{ $appInfo['company_name'] }}<br>
                    {{ $appInfo['address'] }}<br>
                    {{ $appInfo['city'] }}, {{ $appInfo['province'] }}
                    {{ $appInfo['postal_code'] }}</p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">CONTACT US</h5>
                <p class="mb-1 text-sm text-gray-400">{{ $appInfo['phone'] }}</p>
                <p class="text-sm text-gray-400">info@nusadewa.com<br>
                    sales@nusadewa.com</p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">BUSINESS HOURS</h5>
                <p class="text-sm text-gray-400">
                    {!! $appInfo['formattedHours'] !!}
                </p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">NEWSLETTER</h5>
                <livewire:newsletter-subscription />
            </div>
        </div>

        <div class="flex flex-col items-center justify-between pt-4 border-t border-gray-700 md:flex-row">
            <p class="mb-3 text-xs text-gray-400 md:mb-0">&copy; {{ date('Y') }}
                {{ $appInfo['company_name'] }}. All Rights Reserved.</p>
            <div class="flex items-center space-x-4">
                <div href="#" class="text-xs text-gray-400">
                    Made with ❤️ by <a href="https://wa.me/+6281918175060" target="_blank"
                        class="text-primary hover:underline">
                        PRADStudio
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
