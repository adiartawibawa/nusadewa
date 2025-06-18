<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" x-data="{
    mobileMenuOpen: false,
    sidebarOpen: false,
    scrollY: 0,
    parallaxOffset: 0,
    currentLocale: '{{ app()->getLocale() }}',
    init() {
        window.addEventListener('scroll', () => {
            this.scrollY = window.scrollY;
            this.parallaxOffset = this.scrollY * 0.3;
            requestAnimationFrame(() => {
                this.parallaxOffset = this.scrollY * 0.3;
            });
        });
    }
}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Deskripsi default tentang Nusa Dewa">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Nusa Dewa - Aquaculture Innovation')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }

        .preloader {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('https://bpiu2k.online/img/logo.png');
            background-repeat: no-repeat;
            background-position: center;
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bg-noise {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%' height='100%' filter='url(%23noiseFilter)' opacity='0.2'/%3E%3C/svg%3E");
        }

        .will-change-transform {
            will-change: transform;
        }

        @media (max-width: 1023px) {
            .parallax-bg {
                background-attachment: scroll;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased bg-white" x-cloak>
    <!-- Preloader -->
    <div class="fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-500 bg-white preloader"
        x-show="true" x-transition:enter="transition-opacity duration-300"
        x-transition:leave="transition-opacity duration-300" x-init="setTimeout(() => { $el.remove() }, 1000)">
        <div class="w-20 h-20 border-t-2 border-b-2 border-blue-500 rounded-full animate-spin"></div>
    </div>

    <!-- Sidebar Panel -->
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
                    <h3 class="mb-4 text-xl font-bold">Quick contact info</h3>
                    <p class="text-sm text-gray-600">Sebagai pusat pembenihan udang vaname terkemuka di Bali, kami siap
                        membantu Anda dengan solusi akuakultur berbasis bioteknologi.</p>
                </div>

                <div>
                    <h5 class="font-bold text-gray-800">CONTACT</h5>
                    <a href="tel:0363-2787803"
                        class="text-sm font-semibold text-blue-600 hover:underline">0363-2787803</a>
                    <a href="mailto:bpiu2k@gmail.com"
                        class="block text-sm text-gray-600 hover:underline">bpiu2k@gmail.com</a>
                </div>

                <div>
                    <h5 class="font-bold text-gray-800">OFFICE</h5>
                    <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank" rel="noopener noreferrer"
                        class="text-sm text-gray-600 hover:underline">
                        Desa Bugbug —<br>Karangasem, <br>Bali 80811
                    </a>
                </div>

                <div>
                    <h5 class="font-bold text-gray-800">OPENING HOURS</h5>
                    <p class="text-sm text-gray-600">
                        Monday – Thursday : 07:30AM – 16:00PM<br>
                        Friday : 07:30AM – 16:30PM<br>
                        Sunday : Closed
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto bg-white" style="display: none;">
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
                        <a href="#"
                            class="block text-gray-600 transition-colors hover:text-primary">Innovation</a>
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
                        <a href="#"
                            class="block text-gray-600 transition-colors hover:text-primary">WSSV-Resistant Strain</a>
                        <a href="#"
                            class="block text-gray-600 transition-colors hover:text-primary">EHP-Resistant Strain</a>
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
                        <a href="#"
                            class="block text-gray-600 transition-colors hover:text-primary">Multilocation Test
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

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="pt-12 pb-6 text-white bg-gray-900">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center justify-between pb-6 mb-6 border-b border-gray-700 md:flex-row">
                <div class="mb-4 md:mb-0">
                    <img src="https://bpiu2k.online/img/logo.png" alt="Nusa Dewa Logo" class="h-10">
                </div>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="{{ route('home') }}" class="transition-colors hover:text-primary">Home</a>
                    <a href="#" class="transition-colors hover:text-primary">About Us</a>
                    <a href="#" class="transition-colors hover:text-primary">Our
                        Products</a>
                    <a href="#" class="transition-colors hover:text-primary">Research</a>
                    <a href="#" class="transition-colors hover:text-primary">News</a>
                    <a href="#" class="transition-colors hover:text-primary">Contact</a>
                </div>
            </div>

            <div class="grid gap-6 mb-8 md:grid-cols-4">
                <div>
                    <h5 class="mb-3 text-base font-semibold">HEADQUARTERS</h5>
                    <p class="text-sm text-gray-400">Indonesia —<br>Nusa Dewa Aquaculture Center<br>
                        Jl. Raya Pemogan No. 123<br>
                        Denpasar, Bali 80361</p>
                </div>

                <div>
                    <h5 class="mb-3 text-base font-semibold">CONTACT US</h5>
                    <p class="mb-1 text-sm text-gray-400">+62 361 123 4567</p>
                    <p class="text-sm text-gray-400">info@nusadewa.com<br>
                        sales@nusadewa.com</p>
                </div>

                <div>
                    <h5 class="mb-3 text-base font-semibold">OPERATIONAL HOURS</h5>
                    <p class="text-sm text-gray-400">Monday – Friday: 08:00AM – 05:00PM<br>
                        Saturday: 08:00AM – 12:00PM<br>
                        Sunday: Closed</p>
                </div>

                <div>
                    <h5 class="mb-3 text-base font-semibold">NEWSLETTER</h5>
                    <livewire:newsletter-subscription />
                </div>
            </div>

            <div class="flex flex-col items-center justify-between pt-4 border-t border-gray-700 md:flex-row">
                <p class="mb-3 text-xs text-gray-400 md:mb-0">&copy; {{ date('Y') }} Nusa Dewa Aquaculture. All
                    Rights Reserved.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 transition-colors hover:text-white">
                        <i class="text-sm fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white">
                        <i class="text-sm fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white">
                        <i class="text-sm fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white">
                        <i class="text-sm fab fa-youtube"></i>
                    </a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white">
                        <i class="text-sm fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#top" x-show="scrollY > 300" x-transition.opacity
        class="fixed z-40 flex items-center justify-center w-12 h-12 text-white transition-all duration-300 transform rounded-full shadow-lg bottom-6 right-6 bg-primary hover:bg-secondary hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script>
        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            if (preloader) {
                preloader.style.transition = 'opacity 0.5s ease';
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 1000);
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    if (window.innerWidth < 768) {
                        Alpine.store('mobileMenuOpen', false);
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
