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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $seo['description'] ?? $appInfo['company_description'] }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? '' }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ $appInfo['companyLogo'] }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo['title'] ?? $appInfo['company_name'] }} - {{ $title ?? 'Aquaculture Innovation' }}</title>

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

        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s infinite;
        }

        @media (max-width: 1023px) {
            .parallax-bg {
                background-attachment: scroll;
            }
        }
    </style>

    @stack('styles')

    @livewireStyles

</head>

<body id="top" class="font-sans antialiased bg-gray-800" x-cloak>

    <!-- Preloader -->
    <div class="fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-500 bg-white preloader"
        x-show="true" x-transition:enter="transition-opacity duration-300"
        x-transition:leave="transition-opacity duration-300" x-init="setTimeout(() => { $el.remove() }, 1000)">
        <div class="w-20 h-20 border-t-2 border-b-2 border-blue-500 rounded-full animate-spin"></div>
    </div>

    <!-- Sidebar Panel -->
    <x-layouts.sidebar :appInfo="$appInfo" />

    <!-- Mobile Menu -->
    <x-layouts.mobile-menu />

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-layouts.footer :appInfo="$appInfo ?? null" />

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

    @livewireScripts

    @stack('scripts')

</body>

</html>
