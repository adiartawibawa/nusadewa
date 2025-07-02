<div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto bg-white dark:bg-gray-800"
    style="display: none;">
    <div class="container px-4 py-6 mx-auto sm:py-8">
        <div class="flex items-center justify-between mb-6 sm:mb-8">
            <img src="{{ $appInfo['companyLogo'] }}" alt="{{ $appInfo['company_name'] }} Logo" class="h-8 sm:h-10">
            <button @click="mobileMenuOpen = false"
                class="text-gray-500 dark:text-gray-300 hover:text-primary dark:hover:text-primary">
                <i class="text-lg sm:text-xl fas fa-times"></i>
            </button>
        </div>

        <div class="space-y-4 sm:space-y-6">
            <a href="{{ route('home') }}"
                class="block pb-3 text-sm font-medium text-gray-800 transition-colors border-b border-gray-100 sm:pb-4 dark:border-gray-700 sm:text-base dark:text-gray-100 hover:text-primary">Home</a>

            <div x-data="{ open: false }" class="pb-3 border-b border-gray-100 sm:pb-4 dark:border-gray-700">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors sm:text-base dark:text-gray-100 hover:text-primary">
                    About Us <i class="ml-2 text-xs transition-transform sm:text-sm fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-3 mt-2 space-y-2 sm:pl-4 sm:space-y-3">
                    <a href="#innovation"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Innovation</a>
                    <a href="#technology"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Our
                        Expertise</a>
                    <a href="#team"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Our
                        Team</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="pb-3 border-b border-gray-100 sm:pb-4 dark:border-gray-700">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors sm:text-base dark:text-gray-100 hover:text-primary">
                    Our Products <i class="ml-2 text-xs transition-transform sm:text-sm fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-3 mt-2 space-y-2 sm:pl-4 sm:space-y-3">
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">FAST
                        GROWTH Strain</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">WSSV-Resistant
                        Strain</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">EHP-Resistant
                        Strain</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Plant-Based
                        Protein Strain</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">GAJAH
                        MADA Strain</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="pb-3 border-b border-gray-100 sm:pb-4 dark:border-gray-700">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors sm:text-base dark:text-gray-100 hover:text-primary">
                    Technology <i class="ml-2 text-xs transition-transform sm:text-sm fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-3 mt-2 space-y-2 sm:pl-4 sm:space-y-3">
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Molecular
                        Precision</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Performance
                        Testing</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Research
                        & Development</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="pb-3 border-b border-gray-100 sm:pb-4 dark:border-gray-700">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full text-sm font-medium text-gray-800 transition-colors sm:text-base dark:text-gray-100 hover:text-primary">
                    News <i class="ml-2 text-xs transition-transform sm:text-sm fas fa-chevron-down"
                        :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="pl-3 mt-2 space-y-2 sm:pl-4 sm:space-y-3">
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Genome
                        Editing</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">SNP
                        Resistance WSSV</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Bamboo
                        Disease Analysis</a>
                    <a href="#"
                        class="block text-xs text-gray-600 transition-colors sm:text-sm dark:text-gray-300 hover:text-primary">Multilocation
                        Test Results</a>
                </div>
            </div>

            <a href="#contact"
                class="block text-sm font-medium text-gray-800 transition-colors sm:text-base dark:text-gray-100 hover:text-primary">Contact</a>

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
    </div>
</div>
