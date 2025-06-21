<header class="sticky top-0 z-40 transition-all duration-300 bg-transparent">
    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-between py-4">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="https://bpiu2k.online/img/logo.png" alt="Nusa Dewa Logo" class="h-10">
            </a>

            <!-- Desktop Menu -->
            <nav class="items-center hidden space-x-8 md:flex">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium text-white transition-colors hover:text-primary">Home</a>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center text-sm font-medium text-white transition-colors hover:text-primary">
                        About Us <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                            :class="{ 'transform rotate-180': open }"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-0 z-50 w-48 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Our
                            Company</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Innovation</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Our
                            Expertise</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Our
                            Team</a>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center text-sm font-medium text-white transition-colors hover:text-primary">
                        Our Products <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                            :class="{ 'transform rotate-180': open }"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-0 z-50 w-56 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">FAST
                            GROWTH Strain</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">WSSV-Resistant
                            Strain</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">EHP-Resistant
                            Strain</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Plant-Based
                            Protein Strain</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">GAJAH
                            MADA
                            Strain</a>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center text-sm font-medium text-white transition-colors hover:text-primary">
                        Technology <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                            :class="{ 'transform rotate-180': open }"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-0 z-50 w-48 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Molecular
                            Precision</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Performance
                            Testing</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Research
                            &
                            Development</a>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center text-sm font-medium text-white transition-colors hover:text-primary">
                        News <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                            :class="{ 'transform rotate-180': open }"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-0 z-50 w-48 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Genome
                            Editing</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">SNP
                            Resistance WSSV</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Bamboo
                            Disease Analysis</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-800 transition-colors hover:bg-blue-50">Multilocation
                            Test Results</a>
                    </div>
                </div>

                <a href="#"
                    class="text-sm font-medium text-white transition-colors hover:text-primary">Contact</a>

                <button @click="sidebarOpen = true" class="ml-4 text-white transition-colors hover:text-primary">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = true" class="text-white md:hidden hover:text-primary">
                <i class="text-xl text-white fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
