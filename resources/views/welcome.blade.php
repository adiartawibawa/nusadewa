<x-nusa-dewa-layout>

    <!-- Hero Section with Parallax -->
    <section class="relative items-center h-screen overflow-hidden">
        <!-- Header Top -->
        <x-layouts.top-header />

        <!-- Main Navigation -->
        <x-layouts.main-nav />

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
            <div class="mb-4 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Our Innovation</h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
                </div>
                <p class="max-w-2xl mx-auto text-gray-600">State-of-the-art biotechnology for superior shrimp broodstock
                </p>
            </div>

            <livewire:innovation-section />
        </div>
    </section>

    <!-- Technology Section with Parallax -->
    <section class="relative overflow-hidden">
        <livewire:technologies-section />
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

            <livewire:products-section />
        </div>
    </section>

    <!-- News Section -->
    <section class="py-20 bg-white">
        <div class="container px-4 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Berita & Pembaruan Terkini</h2>
                <div class="flex justify-center mx-auto my-6">
                    <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
                </div>
                <p class="max-w-2xl mx-auto text-gray-600">Ikuti perkembangan terbaru penelitian dan inovasi akuakultur
                    kami
                </p>
            </div>

            <livewire:news-section />

    </section>


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
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3262.5774889293316!2d115.59310867408007!3d-8.507101086127756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2091ed2705899%3A0xafb1dc2931f738db!2sBalai%20Produksi%20Induk%20Udang%20Unggul%20Dan%20Kekerangan%20(BPIU2K)%20Karangasem!5e1!3m2!1sid!2sid!4v1750500414281!5m2!1sid!2sid"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            class="transition-all duration-500 filter grayscale hover:grayscale-0"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</x-nusa-dewa-layout>
