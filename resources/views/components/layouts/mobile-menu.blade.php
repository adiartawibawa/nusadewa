<div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto bg-white" style="display: none;">
    <div class="container px-4 py-8 mx-auto">
        <div class="flex items-center justify-between mb-8">
            <img src="{{ $appInfo['companyLogo'] }}" alt="{{ $appInfo['company_name'] }} Logo" class="h-10">
            <button @click="mobileMenuOpen = false" class="text-gray-500 hover:text-primary">
                <i class="text-xl fas fa-times"></i>
            </button>
        </div>

        <div class="space-y-6">
            <a href="{{ route('home') }}"
                class="block text-sm font-medium text-gray-800 transition-colors hover:text-primary">Home</a>

            <div x-data="{ open: false }" class="pb-4 border-b border-gray-100">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors hover:text-primary">
                    About Us <i class="ml-2 text-xs transition-transform fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-4 mt-2 space-y-3">
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Our Company</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Innovation</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Our Expertise</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Our Team</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="pb-4 border-b border-gray-100">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors hover:text-primary">
                    Our Products <i class="ml-2 text-xs transition-transform fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-4 mt-2 space-y-3">
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">FAST GROWTH
                        Strain</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">WSSV-Resistant
                        Strain</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">EHP-Resistant
                        Strain</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Plant-Based
                        Protein Strain</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">GAJAH MADA
                        Strain</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="pb-4 border-b border-gray-100">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors hover:text-primary">
                    Technology <i class="ml-2 text-xs transition-transform fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-4 mt-2 space-y-3">
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Molecular
                        Precision</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Performance
                        Testing</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Research &
                        Development</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="pb-4 border-b border-gray-100">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors hover:text-primary">
                    News <i class="ml-2 text-xs transition-transform fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-4 mt-2 space-y-3">
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Genome
                        Editing</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">SNP Resistance
                        WSSV</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Bamboo Disease
                        Analysis</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Multilocation
                        Test Results</a>
                </div>
            </div>

            <a href="#"
                class="block text-sm font-medium text-gray-800 transition-colors hover:text-primary">Contact</a>

            <!-- Language Switcher for Mobile -->
            {{-- <div x-data="{ open: false }" class="pb-4 border-b border-gray-100">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors hover:text-primary">
                    Language ({{ strtoupper($systemInfo['default_language']) }})
                    <i class="ml-2 text-xs transition-transform fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-4 mt-2 space-y-3">
                    @foreach ($systemInfo['supported_languages'] as $lang)
                        <a href="{{ route('language.switch', $lang) }}"
                            class="block text-gray-600 transition-colors hover:text-primary">
                            {{ strtoupper($lang) }}
                        </a>
                    @endforeach
                </div>
            </div> --}}

            <div class="pt-8 border-t border-gray-200">
                <div class="space-y-4">
                    <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank"
                        class="flex items-center text-xs text-gray-600 transition-colors hover:text-primary">
                        <i class="mr-3 fas fa-map-marker-alt"></i>
                        {{ $appInfo['address'] }}, {{ $appInfo['city'] }} — {{ $appInfo['province'] }}
                        {{ $appInfo['postal_code'] }}, {{ $appInfo['country'] }}
                    </a>
                    <a href="tel:{{ $appInfo['phone'] }}"
                        class="flex items-center text-xs text-gray-600 transition-colors hover:text-primary">
                        <i class="mr-3 fas fa-phone-alt"></i> {{ $appInfo['phone'] }}
                    </a>
                    <div class="flex items-center text-xs text-gray-600">
                        <i class="mr-3 far fa-clock"></i>
                        {!! $appInfo['formattedHours'] !!}
                    </div>
                </div>

                <div class="flex mt-6 space-x-4">
                    @foreach ($socialMedia['social_media'] as $platform => $url)
                        @if ($url)
                            <a href="{{ $url }}" target="_blank"
                                class="text-gray-600 hover:text-{{ $platform == 'youtube' ? 'red' : 'blue' }}-600">
                                <i class="fab fa-{{ $platform }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
