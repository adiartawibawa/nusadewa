<!DOCTYPE html>
<html lang="id" dir="ltr" x-data="{
    mobileMenuOpen: false,
    sidebarOpen: false,
    scrollY: 0,
    parallaxOffset: 0,
    init() {
        window.addEventListener('scroll', () => {
            this.scrollY = window.scrollY;
            this.parallaxOffset = this.scrollY * 0.3;
        });
    }
}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Deskripsi default tentang Nusa Dewa">
    <title>Nusa Dewa - Aquaculture Innovation</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

        @media (max-width: 1023px) {
            .parallax-bg {
                background-attachment: scroll;
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-white" x-cloak>
    <!-- Preloader -->
    <div class="preloader">
        <div class="w-20 h-20 border-t-2 border-b-2 border-blue-500 rounded-full animate-spin"></div>
    </div>

    <!-- Sidebar Panel -->
    <div x-show="sidebarOpen" @click.away="sidebarOpen = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 z-50 overflow-y-auto bg-white shadow-xl w-80">
        <div class="p-6">
            <button @click="sidebarOpen = false" class="absolute text-gray-500 top-4 right-4 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>

            <div class="mt-16 space-y-8">
                <div>
                    <h3 class="mb-4 text-xl font-bold">Quick contact info</h3>
                    <p class="text-gray-600">Sebagai pusat pembenihan udang vaname terkemuka di Bali, kami siap membantu
                        Anda dengan solusi akuakultur berbasis bioteknologi.</p>
                </div>

                <div>
                    <h5 class="font-bold text-gray-800">CONTACT</h5>
                    <div class="text-lg font-semibold text-blue-600">0363-2787803</div>
                    <p class="text-gray-600">bpiu2k@gmail.com</p>
                </div>

                <div>
                    <h5 class="font-bold text-gray-800">OFFICE</h5>
                    <p class="text-gray-600">Desa Bugbug —<br>Karangasem, <br>Bali 80811</p>
                </div>

                <div>
                    <h5 class="font-bold text-gray-800">OPENING HOURS</h5>
                    <p class="text-gray-600">Monday – Thursday : 07:30AM – 16:00PM<br>Friday : 07:30AM –
                        16:30PM<br>Sunday : Closed</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Top -->
    <div class="hidden py-2 bg-gray-100 md:block">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center justify-between md:flex-row">
                <div class="flex flex-wrap justify-center gap-4 mb-2 md:justify-start md:mb-0">
                    <a href="#" class="flex items-center text-sm text-gray-700 hover:text-blue-600">
                        <i class="mr-2 fas fa-phone-alt"></i>0363-2787803
                    </a>
                    <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank"
                        class="flex items-center text-sm text-gray-700 hover:text-blue-600">
                        <i class="mr-2 fas fa-map-marker-alt"></i>Desa Bugbug, Karangasem, Bali 80811
                    </a>
                    <a href="#" class="flex items-center text-sm text-gray-700 hover:text-blue-600">
                        <i class="mr-2 far fa-clock"></i>Mon - Fri 7:30 - 16:00
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex space-x-3">
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

                    <div x-data="{ currentLocale: 'en' }" class="ml-2">
                        <button x-show="currentLocale === 'en'"
                            @click="currentLocale = 'id'; window.location.href = 'http://nusadewa.test/id'"
                            class="text-gray-700 hover:text-blue-600" title="Switch to Bahasa Indonesia">
                            🇮🇩
                        </button>
                        <button x-show="currentLocale === 'id'"
                            @click="currentLocale = 'en'; window.location.href = 'http://nusadewa.test/en'"
                            class="text-gray-700 hover:text-blue-600" title="Switch to English">
                            🇺🇸
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <header class="sticky top-0 z-40 transition-all duration-300 bg-white shadow-sm"
        :class="{ 'bg-opacity-90 backdrop-blur-sm': scrollY > 50 }">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between py-4">
                <a href="index.html" class="flex items-center">
                    <img src="https://bpiu2k.online/img/logo.png" alt="Nusa Dewa Logo" class="h-10">
                </a>

                <!-- Desktop Menu -->
                <nav class="items-center hidden space-x-8 md:flex">
                    <a href="index.html" class="font-medium text-gray-800 transition-colors hover:text-primary">Home</a>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center font-medium text-gray-800 transition-colors hover:text-primary">
                            About Us <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                                :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 z-50 w-48 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                            <a href="about-company.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Our
                                Company</a>
                            <a href="about-innovation.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Innovation</a>
                            <a href="about-expertise.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Our
                                Expertise</a>
                            <a href="about-team.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Our Team</a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center font-medium text-gray-800 transition-colors hover:text-primary">
                            Our Products <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                                :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 z-50 w-56 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                            <a href="products-fast-growth.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">FAST GROWTH
                                Strain</a>
                            <a href="products-wssv-resistant.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">WSSV-Resistant
                                Strain</a>
                            <a href="products-ehp-resistant.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">EHP-Resistant
                                Strain</a>
                            <a href="products-plant-based.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Plant-Based
                                Protein Strain</a>
                            <a href="products-gajah-mada.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">GAJAH MADA
                                Strain</a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center font-medium text-gray-800 transition-colors hover:text-primary">
                            Technology <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                                :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 z-50 w-48 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                            <a href="technology-molecular.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Molecular
                                Precision</a>
                            <a href="technology-testing.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Performance
                                Testing</a>
                            <a href="technology-research.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Research &
                                Development</a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center font-medium text-gray-800 transition-colors hover:text-primary">
                            News <i class="ml-1 text-xs transition-transform fas fa-chevron-down"
                                :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 z-50 w-48 py-1 mt-2 bg-white border border-gray-100 rounded-md shadow-lg">
                            <a href="news-genome-editing.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Genome
                                Editing</a>
                            <a href="news-snp-resistance.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">SNP Resistance
                                WSSV</a>
                            <a href="news-bamboo-disease.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Bamboo Disease
                                Analysis</a>
                            <a href="news-multilocation.html"
                                class="block px-4 py-2 text-gray-800 transition-colors hover:bg-blue-50">Multilocation
                                Test Results</a>
                        </div>
                    </div>

                    <a href="contact.html"
                        class="font-medium text-gray-800 transition-colors hover:text-primary">Contact</a>

                    <button @click="sidebarOpen = true"
                        class="ml-4 text-gray-600 transition-colors hover:text-primary">
                        <i class="fas fa-bars"></i>
                    </button>
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = true" class="text-gray-600 md:hidden hover:text-primary">
                    <i class="text-xl fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section with Parallax -->
    <section class="relative flex items-center h-screen overflow-hidden">
        <div class="absolute inset-0 z-10 bg-black opacity-20"></div>
        <div class="absolute inset-0 z-0 parallax-bg"
            :style="`background-image: url('https://images.unsplash.com/photo-1519122295308-bdb40916b529?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); transform: translateY(${parallaxOffset}px)`">
        </div>

        <div class="container relative z-20 px-4 mx-auto text-center">
            <h1 class="mb-6 text-4xl font-bold text-white md:text-6xl animate-fade-in-up">INNOVATION MEETS AQUACULTURE
            </h1>
            <p class="max-w-3xl mx-auto mb-8 text-xl text-gray-300 delay-100 md:text-2xl animate-fade-in-up">Advanced
                shrimp broodstock breeding combining biotechnology with decades of expertise</p>
            <a href="#contact"
                class="inline-block px-8 py-3 font-semibold text-white transition-colors delay-200 rounded-lg bg-primary hover:bg-secondary animate-fade-in-up">
                Get Started
            </a>
        </div>

        <div class="absolute left-0 right-0 z-20 text-center bottom-8 animate-bounce">
            <a href="#innovation" class="text-2xl text-white">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>


    <!-- Innovation Section -->
    <section id="innovation" class="py-20 bg-gray-50">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Our Innovation</h2>
                <div class="w-20 h-1 mx-auto mb-6 bg-primary"></div>
                <p class="max-w-2xl mx-auto text-gray-600">State-of-the-art biotechnology for superior shrimp
                    broodstock</p>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <div
                    class="p-8 transition-all duration-300 transform bg-white shadow-md rounded-xl hover:shadow-xl hover:-translate-y-2">
                    <div class="h-48 mb-6 overflow-hidden rounded-lg">
                        <img src="https://images.unsplash.com/photo-1721189438751-1026d27b1f78?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Genomic Selection" class="object-cover w-full h-full">
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-800">Genomic Selection</h3>
                    <p class="text-gray-600">Advanced genetic screening for optimal traits with precision breeding
                        techniques to enhance growth and disease resistance.</p>
                </div>

                <div
                    class="p-8 transition-all duration-300 transform bg-white shadow-md rounded-xl hover:shadow-xl hover:-translate-y-2">
                    <div class="h-48 mb-6 overflow-hidden rounded-lg">
                        <img src="https://images.unsplash.com/photo-1518471663599-b686196bdab8?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Disease Resistance" class="object-cover w-full h-full">
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-800">Disease Resistance</h3>
                    <p class="text-gray-600">Rigorous pathogen profiling and selective breeding for enhanced
                        survivability against major shrimp diseases.</p>
                </div>

                <div
                    class="p-8 transition-all duration-300 transform bg-white shadow-md rounded-xl hover:shadow-xl hover:-translate-y-2">
                    <div class="h-48 mb-6 overflow-hidden rounded-lg">
                        <img src="https://images.unsplash.com/photo-1565926670755-88c340527be2?q=80&w=1418&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Environmental Conditioning" class="object-cover w-full h-full">
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-800">Precision Conditioning</h3>
                    <p class="text-gray-600">Optimized environments and nutrition protocols for superior broodstock
                        development and reproductive performance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Section with Parallax -->
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 z-0 parallax-bg"
            :style="`background-image: url('https://images.unsplash.com/photo-1668243304603-7ecf4eefba6e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bGFiJTIwTW9sZWN1bGFyJTIwVGVjaG5vbG9neXxlbnwwfDB8MHx8fDI%3D'); transform: translateY(${parallaxOffset * 0.5}px)`">
        </div>
        <div class="absolute inset-0 z-10 bg-primary opacity-90"></div>

        <div class="container relative z-20 px-4 mx-auto">
            <div class="flex flex-col items-center gap-12 md:flex-row">
                <div class="md:w-1/2">
                    <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl">MOLECULAR PRECISION</h2>
                    <div class="w-20 h-1 mb-6 bg-white"></div>
                    <p class="mb-4 text-gray-200">At the heart of <span class="font-semibold text-white">Induk Udang
                            Nusa Dewa</span> lies cutting-edge molecular technology that ensures precision in every
                        broodstock. Through advanced genetic screening and selective breeding, we deliver shrimp
                        broodstock with superior health, growth performance, and disease resistance.</p>
                    <p class="text-gray-200">This scientific approach eliminates guesswork, guaranteeing consistent
                        quality and performance that meets global aquaculture standards. With <span
                            class="font-semibold text-white">Nusa Dewa</span>, you're not just farming shrimp — you're
                        cultivating a future of reliability, traceability, and profitability.</p>
                </div>
                <div class="md:w-1/2">
                    <div class="p-1 bg-white rounded-lg shadow-xl">
                        <img src="https://images.unsplash.com/photo-1668243304603-7ecf4eefba6e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bGFiJTIwTW9sZWN1bGFyJTIwVGVjaG5vbG9neXxlbnwwfDB8MHx8fDI%3D"
                            alt="Molecular Technology" class="w-full h-auto rounded-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Performance Testing Section -->
    <section class="py-20 bg-white">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">MULTILOCATION PERFORMANCE TEST</h2>
                <div class="w-20 h-1 mx-auto mb-6 bg-primary"></div>
                <p class="max-w-4xl mx-auto text-gray-600">Proven adaptability across diverse farming conditions</p>
            </div>

            <div class="flex flex-col items-center gap-12 lg:flex-row">
                <div class="lg:w-1/2">
                    <div class="relative overflow-hidden shadow-xl rounded-xl">
                        <img src="https://images.unsplash.com/photo-1572015242290-d9132e2b6d52?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Performance Testing" class="w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-semibold">Real-World Validation</h3>
                            <p>Testing across multiple farming environments</p>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <div class="space-y-6">
                        <p class="text-gray-700">At <span class="font-semibold">NUSA DEWA</span>, we go beyond the lab
                            to ensure real-world success. Our vannamei broodstock is tested across multiple farming
                            locations—spanning various climates, salinities, and systems—to guarantee consistent
                            performance wherever they're cultivated.</p>
                        <p class="text-gray-700">This <span class="font-semibold">Multilocation Performance
                                Test</span> validates key traits like fast growth, high survival, and disease resistance
                            under practical conditions. The result? Proven adaptability, lower production risks, and
                            peace of mind for farmers around the world. With <span class="font-semibold">NUSA
                                DEWA</span>, field-tested performance isn't just a promise—it's a proven standard.</p>

                        <div class="grid grid-cols-2 gap-4 mt-8">
                            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                <div class="mb-2 text-3xl font-bold text-primary">98%</div>
                                <div class="text-gray-600">Survival Rate</div>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                <div class="mb-2 text-3xl font-bold text-primary">1.8x</div>
                                <div class="text-gray-600">Growth Efficiency</div>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                <div class="mb-2 text-3xl font-bold text-primary">12+</div>
                                <div class="text-gray-600">Testing Locations</div>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                <div class="mb-2 text-3xl font-bold text-primary">24/7</div>
                                <div class="text-gray-600">Technical Support</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Global Reach Section with Parallax -->
    <section class="relative py-32 overflow-hidden">
        <div class="absolute inset-0 z-0 parallax-bg"
            :style="`background-image: url('https://images.unsplash.com/photo-1572015242290-d9132e2b6d52?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); transform: translateY(${parallaxOffset * 0.7}px)`">
        </div>
        <div class="absolute inset-0 z-10 bg-dark opacity-80"></div>

        <div class="container relative z-20 px-4 mx-auto">
            <div class="max-w-2xl">
                <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl">WORLDWIDE ACCESS</h2>
                <div class="w-20 h-1 mb-6 bg-white"></div>
                <p class="mb-4 text-gray-300">Strategically located in Bali, our vannamei broodstock breeding program
                    is designed with global reach in mind. With international-standard biosecurity, advanced genetics,
                    and streamlined export capabilities, we offer premium broodstock to aquaculture markets around the
                    world.</p>
                <p class="text-gray-300">From Southeast Asia to the Americas, <span
                        class="font-semibold text-white">Bali-bred</span> vannamei shrimp deliver consistent quality,
                    disease resistance, and performance that meets the demands of modern shrimp farming. Wherever you
                    farm, <span class="font-semibold text-white">Nusa Dewa broodstock</span> brings Bali's innovation
                    to your pond — reliably, efficiently, and sustainably.</p>

                <div class="flex flex-wrap gap-4 mt-8">
                    <div
                        class="px-4 py-2 text-white bg-white border border-white rounded-full bg-opacity-10 backdrop-blur-sm border-opacity-20">
                        <i class="mr-2 fas fa-globe-asia"></i> Southeast Asia
                    </div>
                    <div
                        class="px-4 py-2 text-white bg-white border border-white rounded-full bg-opacity-10 backdrop-blur-sm border-opacity-20">
                        <i class="mr-2 fas fa-globe-americas"></i> Latin America
                    </div>
                    <div
                        class="px-4 py-2 text-white bg-white border border-white rounded-full bg-opacity-10 backdrop-blur-sm border-opacity-20">
                        <i class="mr-2 fas fa-globe-africa"></i> Africa
                    </div>
                    <div
                        class="px-4 py-2 text-white bg-white border border-white rounded-full bg-opacity-10 backdrop-blur-sm border-opacity-20">
                        <i class="mr-2 fas fa-globe-europe"></i> Middle East
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section class="py-20 bg-gray-50">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">SOLID EXPERTISE</h2>
                <div class="w-20 h-1 mx-auto mb-6 bg-primary"></div>
                <p class="max-w-2xl mx-auto text-gray-600">Our multidisciplinary team of aquaculture specialists</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Team Member 1 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white shadow-md rounded-xl hover:shadow-xl">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1566753323558-f4e0952af115?q=80&w=1442&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Wendy Tri Prabowo" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-1 text-xl font-bold text-gray-800">Wendy Tri Prabowo</h3>
                        <p class="mb-3 font-medium text-primary">Director of Shrimp Breeding Center</p>
                        <p class="text-gray-600">20+ years expertise in shrimp breeding, focusing on high-performance
                            strains through selective breeding and genome editing analysis.</p>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white shadow-md rounded-xl hover:shadow-xl">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1557862921-37829c790f19?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Bagus Rahmat Basuki" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-1 text-xl font-bold text-gray-800">Bagus Rahmat Basuki</h3>
                        <p class="mb-3 font-medium text-primary">Molecular and Biotechnology Lab Coordinator</p>
                        <p class="text-gray-600">16+ years in genetic research, specializing in disease-resistant
                            shrimp strains and WSSV resistance markers.</p>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white shadow-md rounded-xl hover:shadow-xl">
                    <div class="flex items-center justify-center h-64 overflow-hidden bg-gray-200">
                        <i class="text-6xl text-gray-400 fas fa-user"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-1 text-xl font-bold text-gray-800">M. Suyuti</h3>
                        <p class="mb-3 font-medium text-primary">Broodstock Center Coordinator</p>
                        <p class="text-gray-600">23+ years in hatchery management, specializing in broodstock
                            conditioning and sustainable aquaculture systems.</p>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white shadow-md rounded-xl hover:shadow-xl">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1589386417686-0d34b5903d23?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Faisal Ramadhan" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-1 text-xl font-bold text-gray-800">Faisal Ramadhan</h3>
                        <p class="mb-3 font-medium text-primary">Public Services and Quality Control</p>
                        <p class="text-gray-600">17+ years bridging technical excellence with community engagement and
                            farmer partnerships.</p>
                    </div>
                </div>

                <!-- Team Member 5 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white shadow-md rounded-xl hover:shadow-xl">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1604364721460-0cbc5866219d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Ni Luh Eka S.J.W" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-1 text-xl font-bold text-gray-800">Ni Luh Eka S.J.W</h3>
                        <p class="mb-3 font-medium text-primary">Human Resources Coordinator</p>
                        <p class="text-gray-600">17+ years in HR management, aligning human capital with technical
                            aquaculture demands.</p>
                    </div>
                </div>

                <!-- Commitment Card -->
                <div
                    class="overflow-hidden transition-shadow duration-300 shadow-md bg-primary rounded-xl hover:shadow-xl">
                    <div class="flex flex-col justify-center h-full p-6 text-white">
                        <h3 class="mb-4 text-xl font-bold">Our Commitment</h3>
                        <p class="mb-4">At <span class="font-semibold">NUSA DEWA</span>, our strength lies in
                            experience. Our breeding program is led by a multidisciplinary team who have spent years
                            perfecting the science of vannamei broodstock.</p>
                        <p>Every decision—from genetic selection to performance evaluation—is grounded in proven
                            research and real-world insight. With a commitment to continuous improvement and data-driven
                            practices, we don't just follow standards — we set them.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-20 bg-dark">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-white md:text-4xl">Our Products</h2>
                <div class="w-20 h-1 mx-auto mb-6 bg-white"></div>
                <p class="max-w-2xl mx-auto text-gray-300">Specialized shrimp strains for diverse aquaculture needs</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Product 1 -->
                <div
                    class="overflow-hidden transition-all duration-300 transform bg-white border border-white bg-opacity-10 backdrop-blur-sm rounded-xl border-opacity-20 hover:border-opacity-40 hover:-translate-y-2">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1654346713140-e78bda148084?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="FAST GROWTH strain" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-3 text-xl font-bold text-white">FAST GROWTH STRAIN</h3>
                        <p class="text-gray-300">Superior growth rates under commercial farming conditions, selectively
                            bred for rapid weight gain and efficient feed conversion.</p>
                        <a href="#"
                            class="inline-block mt-4 font-medium transition-colors text-primary hover:text-white">
                            Learn More <i class="ml-1 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Product 2 -->
                <div
                    class="overflow-hidden transition-all duration-300 transform bg-white border border-white bg-opacity-10 backdrop-blur-sm rounded-xl border-opacity-20 hover:border-opacity-40 hover:-translate-y-2">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1625943555419-56a2cb25a7f2?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="WSSV-Resistant strain" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-3 text-xl font-bold text-white">WSSV-RESISTANT STRAIN</h3>
                        <p class="text-gray-300">Genetically improved to combat White Spot Syndrome Virus,
                            demonstrating enhanced survival rates under virus exposure.</p>
                        <a href="#"
                            class="inline-block mt-4 font-medium transition-colors text-primary hover:text-white">
                            Learn More <i class="ml-1 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Product 3 -->
                <div
                    class="overflow-hidden transition-all duration-300 transform bg-white border border-white bg-opacity-10 backdrop-blur-sm rounded-xl border-opacity-20 hover:border-opacity-40 hover:-translate-y-2">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1565695245408-5a1d73b3b9fe?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="EHP-Resistant strain" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="mb-3 text-xl font-bold text-white">EHP-RESISTANT STRAIN</h3>
                        <p class="text-gray-300">Specialized to address Enterocytozoon hepatopenaei, reducing growth
                            retardation in infected environments.</p>
                        <a href="#"
                            class="inline-block mt-4 font-medium transition-colors text-primary hover:text-white">
                            Learn More <i class="ml-1 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Product 4 - Full width -->
                <div
                    class="overflow-hidden transition-all duration-300 transform bg-white border border-white md:col-span-2 bg-opacity-10 backdrop-blur-sm rounded-xl border-opacity-20 hover:border-opacity-40 hover:-translate-y-2">
                    <div class="md:flex">
                        <div class="h-64 md:w-1/2 md:h-auto">
                            <img src="https://images.unsplash.com/photo-1625943555419-56a2cb25a7f2?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Plant-Based Protein strain" class="object-cover w-full h-full">
                        </div>
                        <div class="p-6 md:w-1/2">
                            <h3 class="mb-3 text-xl font-bold text-white">PLANT-BASED PROTEIN STRAIN</h3>
                            <p class="mb-4 text-gray-300">Optimized for high performance on plant-based diets,
                                supporting sustainable and cost-efficient aquaculture.</p>
                            <p class="text-gray-300">This innovative strain reduces reliance on fishmeal while
                                maintaining excellent growth rates and feed conversion ratios.</p>
                            <a href="#"
                                class="inline-block mt-4 font-medium transition-colors text-primary hover:text-white">
                                Learn More <i class="ml-1 fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product 5 - Full width -->
                <div
                    class="overflow-hidden transition-all duration-300 transform bg-white border border-white md:col-span-2 bg-opacity-10 backdrop-blur-sm rounded-xl border-opacity-20 hover:border-opacity-40 hover:-translate-y-2">
                    <div class="flex-row-reverse md:flex">
                        <div class="h-64 md:w-1/2 md:h-auto">
                            <img src="https://images.unsplash.com/photo-1565695245408-5a1d73b3b9fe?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="GAJAH MADA strain" class="object-cover w-full h-full">
                        </div>
                        <div class="p-6 md:w-1/2">
                            <h3 class="mb-3 text-xl font-bold text-white">GAJAH MADA STRAIN</h3>
                            <p class="mb-4 text-gray-300">Regionally adaptive line designed for diverse environments,
                                excelling under varying water qualities and disease pressures.</p>
                            <p class="text-gray-300">Named after the legendary Indonesian statesman, this strain
                                represents our commitment to local adaptability and resilience.</p>
                            <a href="#"
                                class="inline-block mt-4 font-medium transition-colors text-primary hover:text-white">
                                Learn More <i class="ml-1 fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-20 bg-white">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Shared News</h2>
                <div class="w-20 h-1 mx-auto mb-6 bg-primary"></div>
                <p class="max-w-2xl mx-auto text-gray-600">Latest research and developments from Nusa Dewa</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- News 1 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Genome Editing" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <div class="mb-2 text-sm font-semibold text-primary">RESEARCH • MAR 15, 2023</div>
                        <h3 class="mb-3 text-xl font-bold text-gray-800">Genome Editing: Osteocrin</h3>
                        <p class="mb-4 text-gray-600">Advances in genetic modification for improved shrimp traits
                            through targeted genome editing techniques.</p>
                        <a href="#"
                            class="inline-flex items-center font-medium transition-colors text-primary hover:text-secondary">
                            Read More <i class="ml-2 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- News 2 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="SNP Resistance" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <div class="mb-2 text-sm font-semibold text-primary">DISCOVERY • FEB 28, 2023</div>
                        <h3 class="mb-3 text-xl font-bold text-gray-800">SNP Resistance WSSV</h3>
                        <p class="mb-4 text-gray-600">Identifying genetic markers for White Spot Syndrome resistance
                            through single nucleotide polymorphism analysis.</p>
                        <a href="#"
                            class="inline-flex items-center font-medium transition-colors text-primary hover:text-secondary">
                            Read More <i class="ml-2 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- News 3 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Bamboo Disease" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <div class="mb-2 text-sm font-semibold text-primary">ANALYSIS • JAN 12, 2023</div>
                        <h3 class="mb-3 text-xl font-bold text-gray-800">Bamboo Disease Analysis</h3>
                        <p class="mb-4 text-gray-600">Comprehensive research on emerging pathogens in aquaculture
                            systems and their impact on shrimp health.</p>
                        <a href="#"
                            class="inline-flex items-center font-medium transition-colors text-primary hover:text-secondary">
                            Read More <i class="ml-2 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- News 4 -->
                <div
                    class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl">
                    <div class="h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Multilocation Test" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <div class="mb-2 text-sm font-semibold text-primary">REPORT • DEC 5, 2022</div>
                        <h3 class="mb-3 text-xl font-bold text-gray-800">Multilocation Test: Progress Report</h3>
                        <p class="mb-4 text-gray-600">Field performance of our OI strain across diverse environments
                            with comparative growth metrics and survival rates.</p>
                        <a href="#"
                            class="inline-flex items-center font-medium transition-colors text-primary hover:text-secondary">
                            Read More <i class="ml-2 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#"
                    class="inline-block px-8 py-3 font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-secondary">
                    View All News
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-50">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Contact Us</h2>
                <div class="w-20 h-1 mx-auto mb-6 bg-primary"></div>
                <p class="max-w-2xl mx-auto text-gray-600">Get in touch with our aquaculture experts</p>
            </div>

            <div class="flex flex-col gap-12 lg:flex-row">
                <div class="lg:w-1/2">
                    <div class="h-full p-8 bg-white shadow-md rounded-xl">
                        <h3 class="mb-6 text-2xl font-bold text-gray-800">Contact Information</h3>

                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="p-3 mr-4 rounded-full bg-primary bg-opacity-10 text-primary">
                                    <i class="text-lg fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 font-semibold text-gray-800">Email</h4>
                                    <p class="text-gray-600">info@nusadewa.com</p>
                                    <p class="text-gray-600">sales@nusadewa.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-3 mr-4 rounded-full bg-primary bg-opacity-10 text-primary">
                                    <i class="text-lg fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 font-semibold text-gray-800">Phone</h4>
                                    <p class="text-gray-600">+62 361 1234567 (Office)</p>
                                    <p class="text-gray-600">+62 812 3456 7890 (Technical Support)</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-3 mr-4 rounded-full bg-primary bg-opacity-10 text-primary">
                                    <i class="text-lg fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 font-semibold text-gray-800">Headquarters</h4>
                                    <p class="text-gray-600">Nusa Dewa Aquaculture Center<br>
                                        Jl. Raya Pemogan No. 123<br>
                                        Denpasar, Bali 80361, Indonesia</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-3 mr-4 rounded-full bg-primary bg-opacity-10 text-primary">
                                    <i class="text-lg fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 font-semibold text-gray-800">Operational Hours</h4>
                                    <p class="text-gray-600">Monday - Friday: 08:00 - 17:00 WITA<br>
                                        Saturday: 08:00 - 12:00 WITA<br>
                                        Sunday: Closed</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h4 class="mb-3 font-semibold text-gray-800">Follow Us</h4>
                            <div class="flex space-x-4">
                                <a href="#"
                                    class="flex items-center justify-center w-10 h-10 text-gray-600 transition-colors bg-gray-100 rounded-full hover:bg-primary hover:text-white">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#"
                                    class="flex items-center justify-center w-10 h-10 text-gray-600 transition-colors bg-gray-100 rounded-full hover:bg-primary hover:text-white">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="flex items-center justify-center w-10 h-10 text-gray-600 transition-colors bg-gray-100 rounded-full hover:bg-primary hover:text-white">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#"
                                    class="flex items-center justify-center w-10 h-10 text-gray-600 transition-colors bg-gray-100 rounded-full hover:bg-primary hover:text-white">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#"
                                    class="flex items-center justify-center w-10 h-10 text-gray-600 transition-colors bg-gray-100 rounded-full hover:bg-primary hover:text-white">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <div class="h-full p-8 bg-white shadow-md rounded-xl">
                        <h3 class="mb-6 text-2xl font-bold text-gray-800">Send Us a Message</h3>

                        <form class="space-y-6">
                            <div class="grid gap-6 md:grid-cols-2">
                                <div>
                                    <label for="name" class="block mb-2 font-medium text-gray-700">Your
                                        Name</label>
                                    <input type="text" id="name"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                                <div>
                                    <label for="email" class="block mb-2 font-medium text-gray-700">Email
                                        Address</label>
                                    <input type="email" id="email"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block mb-2 font-medium text-gray-700">Subject</label>
                                <input type="text" id="subject"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>

                            <div>
                                <label for="message" class="block mb-2 font-medium text-gray-700">Message</label>
                                <textarea id="message" rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                            </div>

                            <button type="submit"
                                class="w-full px-6 py-3 font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-secondary">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div class="w-full h-96">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.215329572943!2d115.2474153153666!3d-8.796876693664336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwNDcnNDguNyJTIDExNcKwMTUnMDEuOCJF!5e0!3m2!1sen!2sid!4v1621234567890!5m2!1sen!2sid"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            class="transition-all duration-500 filter grayscale hover:grayscale-0"></iframe>
    </div>

    <!-- Footer -->
    <footer class="pt-16 pb-8 text-white bg-gray-900">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center justify-between pb-8 mb-8 border-b border-gray-700 md:flex-row">
                <div class="mb-6 md:mb-0">
                    <img src="https://bpiu2k.online/img/logo.png" alt="Nusa Dewa Logo" class="h-12">
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="#" class="transition-colors hover:text-primary">Home</a>
                    <a href="#" class="transition-colors hover:text-primary">About Us</a>
                    <a href="#" class="transition-colors hover:text-primary">Our Products</a>
                    <a href="#" class="transition-colors hover:text-primary">Research</a>
                    <a href="#" class="transition-colors hover:text-primary">News</a>
                    <a href="#" class="transition-colors hover:text-primary">Contact</a>
                </div>
            </div>

            <div class="grid gap-8 mb-12 md:grid-cols-4">
                <div>
                    <h5 class="mb-4 text-lg font-bold">HEADQUARTERS</h5>
                    <p class="text-gray-400">Indonesia —<br>Nusa Dewa Aquaculture Center<br>
                        Jl. Raya Pemogan No. 123<br>
                        Denpasar, Bali 80361</p>
                </div>

                <div>
                    <h5 class="mb-4 text-lg font-bold">CONTACT US</h5>
                    <p class="mb-2 text-gray-400">+62 361 123 4567</p>
                    <p class="text-gray-400">info@nusadewa.com<br>
                        sales@nusadewa.com</p>
                </div>

                <div>
                    <h5 class="mb-4 text-lg font-bold">OPERATIONAL HOURS</h5>
                    <p class="text-gray-400">Monday – Friday: 08:00AM – 05:00PM<br>
                        Saturday: 08:00AM – 12:00PM<br>
                        Sunday: Closed</p>
                </div>

                <div>
                    <h5 class="mb-4 text-lg font-bold">NEWSLETTER</h5>
                    <form class="mb-4">
                        <div class="flex">
                            <input type="email" placeholder="Your email address..."
                                class="w-full px-4 py-2 text-gray-800 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <button type="submit"
                                class="px-4 py-2 text-white transition-colors rounded-r-lg bg-primary hover:bg-secondary">
                                Subscribe
                            </button>
                        </div>
                    </form>
                    <p class="text-sm text-gray-400">Get updates on our latest research and products.</p>
                </div>
            </div>

            <div class="flex flex-col items-center justify-between pt-6 border-t border-gray-700 md:flex-row">
                <p class="mb-4 text-sm text-gray-400 md:mb-0">&copy; 2023 Nusa Dewa Aquaculture. All Rights Reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 transition-colors hover:text-white"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white"><i
                            class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white"><i
                            class="fab fa-youtube"></i></a>
                    <a href="#" class="text-gray-400 transition-colors hover:text-white"><i
                            class="fab fa-instagram"></i></a>
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
</body>

</html>
