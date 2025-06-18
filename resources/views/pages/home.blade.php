@extends('layouts.app')

@section('title', 'Nusa Dewa - Aquaculture Innovation')

@section('content')
    <!-- Hero Section with Parallax -->
    <section class="relative items-center h-screen overflow-hidden">
        <!-- Header Top -->
        <div class="relative z-30 hidden py-2 bg-transparent border-b border-gray-200 border-opacity-20 md:block">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-between md:flex-row">
                    <div class="flex flex-wrap justify-center gap-4 mb-2 text-xs md:justify-start md:mb-0">
                        <a href="tel:0363-2787803" class="flex items-center text-white hover:text-blue-300">
                            <i class="mr-2 fas fa-phone-alt"></i>0363-2787803
                        </a>
                        <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank" rel="noopener noreferrer"
                            class="flex items-center text-white hover:text-blue-300">
                            <i class="mr-2 fas fa-map-marker-alt"></i>Desa Bugbug, Karangasem, Bali 80811
                        </a>
                        <a href="#" class="flex items-center text-white hover:text-blue-300">
                            <i class="mr-2 far fa-clock"></i>Mon - Fri 7:30 - 16:00
                        </a>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex space-x-3">
                            <a href="https://www.facebook.com/BPIU2K/" target="_blank" rel="noopener noreferrer"
                                class="text-white hover:text-blue-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://x.com/bpiu2k_k" target="_blank" rel="noopener noreferrer"
                                class="text-white hover:text-blue-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.instagram.com/bpiu2k/" target="_blank" rel="noopener noreferrer"
                                class="text-white hover:text-blue-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="http://www.youtube.com/@bpiu2kkarangasem939" target="_blank" rel="noopener noreferrer"
                                class="text-white hover:text-red-300">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>

                        <div class="ml-2">
                            <button x-show="currentLocale === 'en'" {{-- @click="currentLocale = 'id'; window.location.href = '{{ route('language.switch', 'id') }}'" --}}
                                class="text-white hover:text-blue-300 focus:outline-none"
                                title="Switch to Bahasa Indonesia">
                                🇮🇩
                            </button>
                            <button x-show="currentLocale === 'id'" {{-- @click="currentLocale = 'en'; window.location.href = '{{ route('language.switch', 'en') }}'" --}}
                                class="text-white hover:text-blue-300 focus:outline-none" title="Switch to English">
                                🇺🇸
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
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
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
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
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
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
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
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
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
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

        <div class="absolute inset-0 z-10 bg-black opacity-20"></div>
        <div class="absolute inset-0 z-0 parallax-bg"
            :style="`background-image: url('https://images.unsplash.com/photo-1519122295308-bdb40916b529?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); transform: translateY(${parallaxOffset}px)`">
        </div>

        <div class="container relative z-20 flex flex-col items-center justify-center h-full px-4 mx-auto text-center">
            <h1 class="mb-6 text-4xl font-bold text-white md:text-6xl animate-fade-in-up">INNOVATION MEETS AQUACULTURE
            </h1>
            <p class="max-w-3xl mx-auto mb-8 text-xl text-gray-300 delay-100 md:text-2xl animate-fade-in-up">
                Advanced shrimp broodstock breeding combining biotechnology with decades of expertise
            </p>
            <a href="#contact"
                class="inline-block px-8 py-3 font-semibold text-white transition-colors delay-200 rounded-lg bg-primary hover:bg-secondary animate-fade-in-up focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Get Started
            </a>
        </div>

        <div class="absolute left-0 right-0 z-20 text-center bottom-8 animate-bounce">
            <a href="#innovation" class="text-2xl text-white focus:outline-none">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>

    <!-- Innovation Section -->
    <section id="innovation" class="py-20 bg-gray-50">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Our Innovation</h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
                </div>
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
            :style="`background-image: url('https://images.unsplash.com/photo-1668243304603-7ecf4eefba6e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bGFiJTIwTW9sZWN1bGFyJTIwVGVjaG5vbG9neXxlbnwwfDB8MHx8fDI%3D'); transform: translateY(${parallaxOffset * 0.3}px)`">
        </div>
        <div class="absolute inset-0 z-10 bg-primary opacity-90"></div>

        <div class="container relative z-20 px-4 mx-auto">
            <div class="flex flex-col items-center gap-12 md:flex-row">
                <div class="md:w-1/2">
                    <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl">MOLECULAR PRECISION</h2>
                    <div class="flex justify-start mx-auto my-6">
                        <span class="inline-block w-40 h-1 bg-white rounded-full"></span>
                        <span class="inline-block w-3 h-1 mx-1 bg-white rounded-full"></span>
                        <span class="inline-block w-1 h-1 bg-white rounded-full"></span>
                    </div>
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
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
                </div>
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
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 z-0 parallax-bg"
            :style="`background-image: url('https://images.unsplash.com/photo-1668243304603-7ecf4eefba6e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bGFiJTIwTW9sZWN1bGFyJTIwVGVjaG5vbG9neXxlbnwwfDB8MHx8fDI%3D'); transform: translateY(${parallaxOffset *0.001}px)`">
        </div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-dark/10 via-dark/70 to-dark/90 z-5"></div>

        <!-- Noise Texture for Depth -->
        <div class="absolute inset-0 z-10 bg-noise opacity-10"></div>
        </div>

        <!-- Content -->
        <div class="container relative z-20 px-4 mx-auto">
            <div class="max-w-2xl">
                <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    WORLDWIDE ACCESS
                </h2>

                <div class="flex justify-start mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-white rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-white rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-white rounded-full"></span>
                </div>

                <p class="mb-4 text-gray-300" x-transition:enter="transition ease-out duration-700 delay-100"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    Strategically located in Bali, our vannamei broodstock breeding program is designed with global
                    reach in mind. With international-standard biosecurity, advanced genetics, and streamlined export
                    capabilities, we offer premium broodstock to aquaculture markets around the world.
                </p>

                <p class="text-gray-300" x-transition:enter="transition ease-out duration-700 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    From Southeast Asia to the Americas, <span class="font-semibold text-white">Bali-bred</span>
                    vannamei shrimp deliver consistent quality, disease resistance, and performance that meets the
                    demands of modern shrimp farming. Wherever you farm, <span class="font-semibold text-white">Nusa
                        Dewa broodstock</span> brings Bali's innovation to your pond — reliably, efficiently, and
                    sustainably.
                </p>

                <div class="flex flex-wrap gap-4 mt-8" x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <div
                        class="px-4 py-2 text-white transition-all duration-300 bg-white border border-white rounded-full hover:bg-opacity-20 bg-opacity-10 backdrop-blur-sm border-opacity-20 hover:border-opacity-40">
                        <i class="mr-2 fas fa-globe-asia"></i> Southeast Asia
                    </div>
                    <div
                        class="px-4 py-2 text-white transition-all duration-300 bg-white border border-white rounded-full hover:bg-opacity-20 bg-opacity-10 backdrop-blur-sm border-opacity-20 hover:border-opacity-40">
                        <i class="mr-2 fas fa-globe-americas"></i> Latin America
                    </div>
                    <div
                        class="px-4 py-2 text-white transition-all duration-300 bg-white border border-white rounded-full hover:bg-opacity-20 bg-opacity-10 backdrop-blur-sm border-opacity-20 hover:border-opacity-40">
                        <i class="mr-2 fas fa-globe-africa"></i> Africa
                    </div>
                    <div
                        class="px-4 py-2 text-white transition-all duration-300 bg-white border border-white rounded-full hover:bg-opacity-20 bg-opacity-10 backdrop-blur-sm border-opacity-20 hover:border-opacity-40">
                        <i class="mr-2 fas fa-globe-europe"></i> Middle East
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section class="relative py-20 bg-gray-50">
        <div class="container px-4 mx-auto overflow-hidden">
            <!-- Section Title -->
            <div class="mb-4 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">SOLID EXPERTISE</h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
                </div>
                <p class="max-w-2xl mx-auto text-gray-600">
                    At NUSA DEWA, our strength lies in experience. Our breeding
                    program is led by a multidisciplinary team who have spent years perfecting the science of vannamei
                    broodstock. Every decision—from genetic selection to performance evaluation—is grounded in proven
                    research and real-world insight.
                </p>
            </div>

            <!-- Livewire Team Slider Component -->
            <livewire:team-slider />
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-20 bg-dark">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-white md:text-4xl">Our Products</h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-white rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-white rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-white rounded-full"></span>
                </div>
                <p class="max-w-2xl mx-auto text-gray-300">Specialized shrimp strains for diverse aquaculture needs</p>
            </div>

            <livewire:products-list />
        </div>
    </section>

    <!-- News Section -->
    <livewire:news-section />


    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-100">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Contact Us</h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
                </div>
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
                    <!-- Livewire Contact Form Component -->
                    <livewire:contact-form />
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div class="w-full h-96">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.215329572943!2d115.2474153153666!3d-8.796876693664336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwNDclMjQ4LjciUyAxMTXCsDE1JzAxLjgiRQ!5e0!3m2!1sen!2sid!4v1621234567890!5m2!1sen!2sid"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            class="transition-all duration-500 filter grayscale hover:grayscale-0"></iframe>
    </div>
@endsection
