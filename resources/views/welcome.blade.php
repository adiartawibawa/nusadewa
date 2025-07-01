<x-nusa-dewa-layout>

    <!-- Hero Section with Enhanced Parallax -->
    <section class="relative h-screen overflow-hidden isolate">
        <!-- Header Components -->
        <x-layouts.top-header />
        <x-layouts.main-nav />

        <!-- Background Overlay -->
        <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/60 to-black/30"></div>

        <!-- Dynamic Background Image with Parallax -->
        <div class="absolute inset-0 z-0 bg-center bg-cover parallax-bg"
            :style="`background-image: url('{{ $appInfo['hero_image'] ?? 'https://images.unsplash.com/photo-1519122295308-bdb40916b529?ixlib=rb-4.1.0&auto=format&fit=crop&w=1374&q=80' }}'); transform: translateY(${parallaxOffset}px)`">
        </div>

        <!-- Hero Content -->
        <div class="container relative z-20 flex flex-col items-center justify-center h-full px-4 mx-auto text-center">
            <div class="w-full max-w-4xl transform translate-y-[-5%]"> <!-- Adjust vertical position here -->
                <h1 class="mb-6 text-4xl font-bold text-white md:text-5xl lg:text-6xl animate-fade-in-up">
                    {{ $appInfo['hero_title'] ?? 'PIONEERING SHRIMP BIOTECHNOLOGY SOLUTIONS' }}
                </h1>

                <p
                    class="max-w-3xl mx-auto mb-8 text-base text-gray-200 delay-100 md:text-lg lg:text-xl animate-fade-in-up">
                    {{ $appInfo['company_description'] ?? 'Cutting-edge aquaculture innovations for sustainable shrimp farming' }}
                </p>

                <div class="flex flex-col items-center gap-4 delay-200 sm:flex-row sm:justify-center animate-fade-in-up">
                    <a href="#contact"
                        class="inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-white transition-all duration-300 rounded-lg md:text-base bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 hover:shadow-lg hover:-translate-y-1">
                        Contact Our Experts
                        <i class="ml-2 fas fa-arrow-right"></i>
                    </a>

                    <a href="#products"
                        class="inline-flex items-center justify-center px-8 py-3 text-sm font-semibold text-white transition-all duration-300 bg-transparent border border-white rounded-lg md:text-base hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 hover:shadow-lg hover:-translate-y-1">
                        Explore Our Products
                        <i class="ml-2 fas fa-search"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Enhanced Scroll Indicator -->
        <div class="absolute bottom-0 left-0 right-0 z-20 flex justify-center">
            <a href="#innovation" class="flex flex-col items-center justify-center mb-8 transition-all group"
                aria-label="Scroll down">
                <div
                    class="flex items-center justify-center transition-all border-2 rounded-full animate-bounce-slow w-9 h-9 border-white/50 group-hover:border-white">
                    <i class="text-white transition-transform fas fa-chevron-down group-hover:translate-y-1"></i>
                </div>
            </a>
        </div>
    </section>

    <!-- Innovation Section -->
    <section id="innovation" class="py-20 bg-gray-50">
        <div class="container px-4 mx-auto">
            <!-- Section Header with Improved Visual Hierarchy -->
            <div class="mb-12 text-center">
                <!-- Main Heading -->
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl lg:text-5xl">
                    Revolutionary Biotechnology Solutions
                </h2>

                <!-- Decorative Divider with Meaningful Design -->
                <div class="flex justify-center mx-auto my-6" aria-hidden="true">
                    <span class="inline-block w-40 h-1 rounded-full bg-primary-500"></span>
                    <span class="inline-block w-3 h-1 mx-1 rounded-full bg-primary-300"></span>
                    <span class="inline-block w-1 h-1 rounded-full bg-primary-200"></span>
                </div>

                <!-- Subheading with Value Proposition -->
                <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
                    Pioneering genetic advancements and sustainable aquaculture technologies
                    for superior shrimp broodstock performance
                </p>
            </div>

            <!-- Dynamic Content Component -->
            <livewire:innovation-section />
        </div>
    </section>

    <!-- Technology Section -->
    <section id="technology" class="relative py-20 overflow-hidden bg-gray-900">
        <!-- Background Ornaments - Diadaptasi dari komponen -->
        <div class="absolute inset-0">
            <div class="tech-slider__bg-ornament tech-slider__bg-grid"></div>
            <div class="tech-slider__bg-ornament tech-slider__bg-circles"></div>
            <div class="tech-slider__blob tech-slider__blob--1"></div>
            <div class="tech-slider__blob tech-slider__blob--2"></div>
            <div class="tech-slider__blob tech-slider__blob--3"></div>
        </div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="mb-16 text-center">
                <!-- Main Heading -->
                <h2 class="mb-4 text-3xl font-bold text-white md:text-4xl lg:text-5xl">
                    Advanced Aquaculture Technologies
                </h2>

                <!-- Decorative Divider - Style konsisten tapi dipertahankan layout asli -->
                <div class="flex justify-center mx-auto my-6" aria-hidden="true">
                    <span class="tech-slider__divider-line tech-slider__divider-line--primary w-40"></span>
                    <span class="tech-slider__divider-line tech-slider__divider-line--secondary w-3 mx-1"></span>
                    <span class="tech-slider__divider-line tech-slider__divider-line--tertiary w-1"></span>
                </div>

                <!-- Subheading -->
                <p class="max-w-3xl mx-auto text-lg text-gray-300 md:text-xl">
                    Cutting-edge molecular breeding and precision aquaculture solutions
                    for optimal shrimp performance
                </p>
            </div>

            <!-- Technology Content with Card Container -->
            <div class="relative z-10">
                <livewire:technologies-section />
            </div>
        </div>
    </section>

    <!-- Performance Testing Section -->
    <section id="performance" class="py-20 bg-white">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">MULTI-LOCATION PERFORMANCE TESTING</h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
                </div>
                <p class="max-w-4xl mx-auto text-gray-600">Proven Excellence Across Diverse Farming Conditions</p>
            </div>

            <div class="flex flex-col items-center gap-12 lg:flex-row">
                <div class="lg:w-1/2">
                    <div class="relative overflow-hidden shadow-xl rounded-xl">
                        <img src="https://images.unsplash.com/photo-1572015242290-d9132e2b6d52?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Vannamei shrimp farming performance testing" class="w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-semibold">Real-World Validation</h3>
                            <p>Rigorously tested across diverse farming environments for unmatched reliability</p>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <div class="space-y-6">
                        <p class="text-gray-700">At <span class="font-semibold text-blue-600">NUSA DEWA</span>, we
                            believe true quality is proven in the field, not just the lab. Our premium vannamei
                            broodstock undergoes extensive <span class="font-semibold">multi-location performance
                                testing</span> across varying climates, water salinities, and farming systems to ensure
                            superior adaptability and consistent results.</p>

                        <p class="text-gray-700">This rigorous testing protocol validates critical performance
                            indicators including <span class="font-semibold">growth rate, survival under stress, disease
                                resistance, and feed efficiency</span>. The outcome? A broodstock solution that delivers
                            predictable, high-yield performance—regardless of your farm's unique conditions.</p>

                        <div class="grid grid-cols-3 gap-4 mt-8">
                            <div
                                class="p-4 border border-gray-200 rounded-lg bg-gray-50 hover:bg-blue-50 transition-colors">
                                <div class="mb-2 text-3xl font-bold text-blue-600">98%</div>
                                <div class="text-gray-600">Average Survival Rate</div>
                            </div>
                            <div
                                class="p-4 border border-gray-200 rounded-lg bg-gray-50 hover:bg-blue-50 transition-colors">
                                <div class="mb-2 text-3xl font-bold text-blue-600">1.8x</div>
                                <div class="text-gray-600">Faster Growth vs Industry Standard</div>
                            </div>
                            <div
                                class="p-4 border border-gray-200 rounded-lg bg-gray-50 hover:bg-blue-50 transition-colors">
                                <div class="mb-2 text-3xl font-bold text-blue-600">24/7</div>
                                <div class="text-gray-600">Dedicated Technical Support</div>
                            </div>
                        </div>

                        <p class="pt-4 text-gray-600 italic">"Our multi-location validation process eliminates
                            guesswork, giving farmers confidence in every batch."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Global Reach Section with Parallax -->
    <section id="globalReach" class="relative py-24 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0 parallax-bg"
            :style="`background-image: url('https://images.unsplash.com/photo-1668243304603-7ecf4eefba6e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bGFiJTIwTW9sZWN1bGFyJTIwVGVjaG5vbG9neXxlbnwwfDB8MHx8fDI%3D'); transform: translateY(${parallaxOffset *0.001}px)`">
        </div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-dark/20 via-dark/80 to-dark/95 z-5"></div>

        <!-- Noise Texture -->
        <div class="absolute inset-0 z-10 bg-noise opacity-15"></div>

        <!-- Content -->
        <div class="container relative z-20 px-4 mx-auto">
            <div class="max-w-2xl">
                <!-- Header Section -->
                <div class="mb-8">
                    <span
                        class="inline-block px-4 py-1 mb-4 text-xs font-semibold tracking-wider text-blue-300 uppercase bg-blue-900/30 rounded-full">
                        Indonesian Excellence
                    </span>
                    <h2 class="mb-4 text-4xl font-bold leading-tight text-white md:text-5xl">
                        <span class="text-blue-300">Bali's</span> Genetic<br>Breakthrough
                    </h2>
                    <div class="flex justify-start my-6">
                        <span class="inline-block w-16 h-1 bg-blue-400 rounded-full"></span>
                        <span class="inline-block w-4 h-1 mx-2 bg-blue-400 rounded-full"></span>
                        <span class="inline-block w-2 h-1 bg-blue-400 rounded-full"></span>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="space-y-6">
                    <p class="text-lg leading-relaxed text-blue-100">
                        At the heart of Indonesia's shrimp revolution, Nusa Dewa combines cutting-edge genetics with
                        traditional aquaculture wisdom to deliver broodstock that outperforms global benchmarks.
                    </p>

                    <!-- Key Metrics -->
                    <div class="grid grid-cols-2 gap-4 my-8">
                        <div class="p-4 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                            <div class="text-3xl font-bold text-blue-300">30+</div>
                            <div class="text-sm font-medium text-blue-100">Export Countries</div>
                        </div>
                        <div class="p-4 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                            <div class="text-3xl font-bold text-blue-300">12-15%</div>
                            <div class="text-sm font-medium text-blue-100">Better FCR</div>
                        </div>
                        <div class="p-4 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                            <div class="text-3xl font-bold text-blue-300">2-35</div>
                            <div class="text-sm font-medium text-blue-100">ppt Salinity Range</div>
                        </div>
                        <div class="p-4 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                            <div class="text-3xl font-bold text-blue-300">28-34°C</div>
                            <div class="text-sm font-medium text-blue-100">Temperature Tolerance</div>
                        </div>
                    </div>

                    <!-- Facility Features -->
                    <div class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                        <h3 class="mb-4 text-xl font-semibold text-white">World-Class Breeding Facility</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-blue-300" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-blue-100">AA+ biosecurity exceeding OIE standards with 24/7
                                    monitoring</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-blue-300" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-blue-100">SPF/SPR certification with full genomic traceability</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-blue-300" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-blue-100">Climate-controlled transport ensuring 98%+ survival
                                    rates</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section id="team" class="relative py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container px-4 mx-auto">
            <!-- Section Header -->
            <div class="max-w-4xl mx-auto mb-16 text-center">
                <span
                    class="inline-block px-4 py-2 mb-4 text-xs font-semibold tracking-wider text-blue-700 uppercase bg-blue-50 rounded-full">
                    Indonesian Aquaculture Pioneer
                </span>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">
                    <span class="text-blue-700">Nusantara's</span> Genetic Legacy
                </h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-24 h-1.5 bg-blue-600 rounded-full"></span>
                    <span class="inline-block w-4 h-1.5 mx-2 bg-blue-600 rounded-full"></span>
                    <span class="inline-block w-2 h-1.5 bg-blue-600 rounded-full"></span>
                </div>
                <p class="text-lg leading-relaxed text-gray-600">
                    At NUSA DEWA, we combine generations of Indonesian aquaculture wisdom with cutting-edge genetic
                    science. Our multidisciplinary team of scientists, hatchery specialists, and field experts has
                    perfected
                    vannamei broodstock that thrives in Indonesia's diverse ecosystems while meeting global aquaculture
                    standards.
                </p>
            </div>

            <!-- National Impact Highlights -->
            <div class="grid max-w-6xl grid-cols-1 gap-8 mx-auto mb-20 lg:grid-cols-3">
                <!-- Coverage Card -->
                <div
                    class="relative p-8 overflow-hidden bg-white rounded-xl shadow-sm border border-gray-100 group hover:shadow-md transition-shadow">
                    <div class="absolute top-0 right-0 w-32 h-32 -mr-10 -mt-10 bg-blue-50 rounded-full opacity-40">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="flex items-center justify-center w-16 h-16 mb-6 text-blue-700 bg-blue-50 rounded-2xl">
                            <i class="text-2xl fas fa-map-marked-alt"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-bold text-gray-800">National Reach</h3>
                        <p class="mb-4 text-gray-600">
                            Supporting 250+ hatcheries across all major Indonesian shrimp farming regions
                        </p>

                    </div>
                </div>

                <!-- Empowerment Card -->
                <div
                    class="relative p-8 overflow-hidden bg-white rounded-xl shadow-sm border border-gray-100 group hover:shadow-md transition-shadow">
                    <div class="absolute top-0 right-0 w-32 h-32 -mr-10 -mt-10 bg-teal-50 rounded-full opacity-40">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="flex items-center justify-center w-16 h-16 mb-6 text-teal-700 bg-teal-50 rounded-2xl">
                            <i class="text-2xl fas fa-users"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-bold text-gray-800">Farmer Development</h3>
                        <p class="mb-4 text-gray-600">
                            Empowering 5,000+ smallholder farmers through comprehensive training programs
                        </p>

                    </div>
                </div>

                <!-- Adaptation Card -->
                <div
                    class="relative p-8 overflow-hidden bg-white rounded-xl shadow-sm border border-gray-100 group hover:shadow-md transition-shadow">
                    <div class="absolute top-0 right-0 w-32 h-32 -mr-10 -mt-10 bg-amber-50 rounded-full opacity-40">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="flex items-center justify-center w-16 h-16 mb-6 text-amber-700 bg-amber-50 rounded-2xl">
                            <i class="text-2xl fas fa-seedling"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-bold text-gray-800">Ecosystem Adaptation</h3>
                        <p class="mb-4 text-gray-600">
                            12 specialized broodstock strains optimized for Indonesia's unique coastal conditions
                        </p>

                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="max-w-6xl mx-auto">
                <div class="mb-10 text-center">
                    <h3 class="mb-3 text-2xl font-bold text-gray-800">Our Scientific Leadership</h3>
                    <p class="max-w-2xl mx-auto text-gray-600">
                        Homegrown experts with global recognition, advancing Indonesia's shrimp aquaculture
                    </p>
                    <div class="flex justify-center mx-auto my-4">
                        <span class="inline-block w-16 h-1 bg-blue-600 rounded-full"></span>
                    </div>
                </div>

                <!-- Livewire Team Slider Component -->
                <livewire:team-slider />
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="product" class="py-20 bg-gradient-to-b from-gray-900 to-gray-800">
        <div class="container px-4 mx-auto">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <span
                    class="inline-block px-4 py-2 mb-4 text-xs font-semibold tracking-wider text-blue-400 uppercase bg-blue-900/30 rounded-full">
                    Premium Genetics
                </span>
                <h2 class="mb-4 text-3xl font-bold text-white md:text-4xl">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-300">NUSA
                        DEWA</span> Product Lines
                </h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-24 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full"></span>
                    <span class="inline-block w-4 h-1 mx-2 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-2 h-1 bg-blue-400 rounded-full"></span>
                </div>
                <p class="text-lg leading-relaxed text-gray-300">
                    Engineered for excellence - our specialized shrimp strains meet diverse aquaculture demands
                    with superior performance characteristics
                </p>
            </div>

            <!-- Products Component -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-full h-full bg-gradient-to-r from-transparent via-gray-900/50 to-transparent"></div>
                </div>
                <livewire:products-section />
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="news" class="py-20 bg-white">
        <div class="container px-4 mx-auto">
            <!-- Section Header -->
            <div class="max-w-4xl mx-auto mb-16 text-center">
                <span
                    class="inline-block px-4 py-2 mb-4 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full">
                    Industry Insights
                </span>
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">
                    <span class="text-blue-600">Aquaculture</span> Innovations & Updates
                </h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-24 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-4 h-1 mx-2 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-2 h-1 bg-blue-500 rounded-full"></span>
                </div>
                <p class="text-lg leading-relaxed text-gray-600">
                    Stay informed with our latest research breakthroughs, industry trends, and technological
                    advancements
                    in shrimp genetics and sustainable aquaculture practices.
                </p>
            </div>

            <!-- News Component -->
            <div class="relative">
                <div
                    class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent">
                </div>
                <livewire:news-section />
                <div
                    class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent">
                </div>
            </div>

            <!-- Optional CTA -->
            <div class="mt-12 text-center">
                <a href="#"
                    class="inline-flex items-center px-6 py-3 text-sm font-medium text-blue-600 transition-all duration-200 border border-blue-200 rounded-full hover:bg-blue-50 hover:border-blue-300">
                    View All Updates
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container px-4 mx-auto">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <span
                    class="inline-block px-4 py-2 mb-4 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full">
                    Connect With Our Experts
                </span>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">
                    <span class="text-blue-600">Aquaculture</span> Support & Inquiries
                </h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-24 h-1.5 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-4 h-1.5 mx-2 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-2 h-1.5 bg-blue-500 rounded-full"></span>
                </div>
                <p class="text-lg leading-relaxed text-gray-600">
                    {{ $appInfo['company_description'] ?? 'Our team of shrimp genetics specialists is ready to assist with technical questions, product information, and partnership opportunities.' }}
                </p>
            </div>

            <div class="flex flex-col gap-12 lg:flex-row">
                <!-- Contact Information -->
                <div class="lg:w-1/2">
                    <div class="h-full p-8 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center mb-6">
                            @if (isset($appInfo['companyLogo']))
                                <img src="{{ $appInfo['companyLogo'] }}"
                                    alt="{{ $appInfo['company_name'] ?? 'Nusa Dewa' }} Logo" class="h-12 mr-4">
                            @endif
                            <h3 class="text-2xl font-bold text-gray-900">Global Contact Channels</h3>
                        </div>

                        <div class="space-y-6">
                            <!-- Email -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 mr-4 text-blue-600 bg-blue-50 rounded-xl">
                                    <i class="text-xl fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2 text-lg font-semibold text-gray-900">Email Support</h4>
                                    <p class="mb-1 text-gray-600">
                                        <span class="font-medium">General Inquiries:</span>
                                        <a href="mailto:{{ $appInfo['email'] ?? 'bpiu2k@gmail.com' }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $appInfo['email'] ?? 'bpiu2k@gmail.com' }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 mr-4 text-blue-600 bg-blue-50 rounded-xl">
                                    <i class="text-xl fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2 text-lg font-semibold text-gray-900">Phone Support</h4>
                                    <p class="text-gray-600">
                                        <span class="font-medium">Main Office:</span>
                                        {{ $appInfo['phone'] ?? '03632787803' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 mr-4 text-blue-600 bg-blue-50 rounded-xl">
                                    <i class="text-xl fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2 text-lg font-semibold text-gray-900">Global Headquarters</h4>
                                    <p class="text-gray-600">
                                        {{ $appInfo['company_name'] ?? 'Nusa Dewa' }}<br>
                                        {{ $appInfo['address'] ?? 'Bugbug Road, Manggis District' }}<br>
                                        {{ $appInfo['city'] ?? 'Karangasem' }}, {{ $appInfo['province'] ?? 'Bali' }}
                                        {{ $appInfo['postal_code'] ?? '80811' }}<br>
                                        {{ $appInfo['country'] ?? 'Indonesia' }}
                                    </p>
                                    <a href="https://maps.google.com?q={{ urlencode($appInfo['address'] ?? 'Bugbug Road, Manggis District') }}"
                                        target="_blank"
                                        class="inline-block mt-2 text-sm text-blue-600 hover:underline">
                                        Get Directions <i class="ml-1 fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Hours -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 mr-4 text-blue-600 bg-blue-50 rounded-xl">
                                    <i class="text-xl fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="mb-2 text-lg font-semibold text-gray-900">Operating Hours</h4>
                                    <p class="text-gray-600">
                                        {!! $appInfo['formattedHours'] ??
                                            'Monday-Friday: 7:30AM - 4:00PM<br>Friday: 7:30AM - 4:30PM<br>Saturday-Sunday: Closed' !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        @if (!empty($socialMedia['social_media']))
                            <div class="pt-8 mt-8 border-t border-gray-200">
                                <h4 class="mb-4 text-lg font-semibold text-gray-900">Connect With Us</h4>
                                <div class="flex space-x-3">
                                    @foreach ($socialMedia['social_media'] as $platform => $url)
                                        @if ($url)
                                            <a href="{{ $url }}" target="_blank"
                                                class="flex items-center justify-center w-10 h-10 text-gray-600 transition-all bg-gray-100 rounded-full hover:bg-blue-600 hover:text-white hover:shadow-md">
                                                <i class="fab fa-{{ $platform }}"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:w-1/2">
                    <livewire:contact-form />
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div class="w-full h-96">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3262.5774889293316!2d115.59310867408007!3d-8.507101086127756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2091ed2705899%3A0xafb1dc2931f738db!2sBalai%20Produksi%20Induk%20Udang%20Unggul%20Dan%20Kekerangan%20(BPIU2K)%20Karangasem!5e1!3m2!1sid!2sid!4v1750500414281!5m2!1sid!2sid"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            class="transition-all duration-500 filter grayscale hover:grayscale-0"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</x-nusa-dewa-layout>
