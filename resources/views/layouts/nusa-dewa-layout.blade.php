@extends('layouts.base')

@push('styles')
    <!-- Global Styles -->
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
@endpush

@section('content')
    <div id="top"
        class="font-sans antialiased text-gray-800 transition-colors duration-300 bg-gray-50 dark:bg-gray-900 dark:text-gray-100"
        x-cloak x-data="appComponent()" x-init="init()">

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

    </div>
@endsection

@push('scripts')
    <script>
        function appComponent() {
            return {
                mobileMenuOpen: false,
                sidebarOpen: false,
                scrollY: 0,
                parallaxOffset: 0,
                currentLocale: '{{ app()->getLocale() }}',
                darkMode: localStorage.getItem('darkMode') === 'true' ||
                    (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),

                init() {
                    // Scroll handler
                    window.addEventListener('scroll', () => {
                        this.scrollY = window.scrollY;
                        requestAnimationFrame(() => {
                            this.parallaxOffset = this.scrollY * 0.3;
                        });
                    });

                    // Dark mode toggle
                    this.$watch('darkMode', (value) => {
                        localStorage.setItem('darkMode', value);
                        document.documentElement.classList.toggle('dark', value);
                    });

                    // Initial dark mode setting
                    document.documentElement.classList.toggle('dark', this.darkMode);

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

                                // Close mobile menu if open (using Alpine store)
                                if (window.innerWidth < 768) {
                                    Alpine.store('mobileMenuOpen', false);
                                }
                            }
                        });
                    });
                },

                switchLocale() {
                    const targetLocale = this.currentLocale === 'en' ? 'id' : 'en';
                    window.location.href = `/set-locale/${targetLocale}`;
                }
            }
        }

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
    </script>
@endpush
