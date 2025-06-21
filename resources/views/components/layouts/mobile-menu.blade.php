<div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto bg-white" style="display: none;">
    <div class="container px-4 py-8 mx-auto">
        <div class="flex items-center justify-between mb-8">
            <img src="https://bpiu2k.online/img/logo.png" alt="Nusa Dewa Logo" class="h-10">
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
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Our
                        Company</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Innovation</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Our
                        Expertise</a>
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
                        Protein
                        Strain</a>
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
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">SNP
                        Resistance WSSV</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Bamboo
                        Disease
                        Analysis</a>
                    <a href="#" class="block text-gray-600 transition-colors hover:text-primary">Multilocation
                        Test
                        Results</a>
                </div>
            </div>

            <a href="#"
                class="block text-sm font-medium text-gray-800 transition-colors hover:text-primary">Contact</a>

            <div class="pt-8 border-t border-gray-200">
                <div class="space-y-4">
                    <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank"
                        class="flex items-center text-xs text-gray-600 transition-colors hover:text-primary">
                        <i class="mr-3 fas fa-map-marker-alt"></i> Desa Bugbug — Karangasem, Bali 80811
                    </a>
                    <a href="#"
                        class="flex items-center text-xs text-gray-600 transition-colors hover:text-primary">
                        <i class="mr-3 fas fa-phone-alt"></i> 0363-2787803
                    </a>
                    <a href="#"
                        class="flex items-center text-xs text-gray-600 transition-colors hover:text-primary">
                        <i class="mr-3 far fa-clock"></i> Mon - Fri 7:30 - 16:00 | Friday : 07:30AM – 16:30PM
                    </a>
                </div>

                <div class="flex mt-6 space-x-4">
                    <a href="https://www.facebook.com/BPIU2K/" target="_blank"
                        class="text-gray-600 hover:text-blue-600">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://x.com/bpiu2k_k" target="_blank" class="text-gray-600 hover:text-blue-600">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/bpiu2k/" target="_blank"
                        class="text-gray-600 hover:text-blue-600">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="http://www.youtube.com/@bpiu2kkarangasem939" target="_blank"
                        class="text-gray-600 hover:text-red-600">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
