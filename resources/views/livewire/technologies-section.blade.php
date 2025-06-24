<style>
    /* Animation Styles */
    @keyframes reveal {
        from {
            clip-path: inset(0 100% 0 0);
        }

        to {
            clip-path: inset(0 0 0 0);
        }
    }

    @keyframes textReveal {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes shine {
        from {
            transform: translateX(-100%) rotate(45deg);
        }

        to {
            transform: translateX(200%) rotate(45deg);
        }
    }

    /* Component Styles */
    .tech-slider-container {
        position: relative;
        height: 100vh;
        overflow: hidden;
    }

    .tech-slider {
        scrollbar-width: none;
        height: 100%;
    }

    .tech-slider::-webkit-scrollbar {
        display: none;
    }

    .tech-dots-container {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 50;
    }

    .shine-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transform: translateX(-100%) rotate(45deg);
    }

    .shine-effect:hover::before {
        animation: shine 1.5s;
    }

    .tech-divider span {
        height: 2px;
        background-color: white;
        border-radius: 9999px;
        display: block;
    }

    .tech-divider span:nth-child(1) {
        width: 10rem;
    }

    .tech-divider span:nth-child(2) {
        width: 0.75rem;
        margin: 0 0.25rem;
    }

    .tech-divider span:nth-child(3) {
        width: 0.25rem;
    }

    @media (max-width: 767px) {
        .tech-slide-content {
            padding-top: 2rem;
            padding-bottom: 4rem;
        }

        .tech-image-container {
            height: 20rem;
            margin-bottom: 1rem;
        }

        .tech-dots-container {
            right: 0.5rem;
        }
    }
</style>

<div class="relative w-full bg-neutral-950 text-white tech-slider-container">
    @if ($posts && count($posts) > 0)
        <!-- Main scroll container -->
        <div class="tech-slider scroll-container overflow-y-auto" id="tech-scroll-container">
            @foreach ($posts as $index => $post)
                <!-- Each slide section -->
                <section class="scroll-section relative w-full h-screen min-h-[600px]">
                    <div class="container h-full mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col md:flex-row items-center h-full gap-6 lg:gap-12 py-8 md:py-12">
                            <!-- Image Column -->
                            <div
                                class="w-full md:w-1/2 h-auto md:h-full tech-image-container flex items-center justify-center">
                                <div
                                    class="p-1 bg-white rounded-lg shadow-xl w-full h-full max-h-[500px] overflow-hidden">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}"
                                        class="w-full h-full object-cover rounded-lg transition duration-300 hover:scale-105">
                                </div>
                            </div>

                            <!-- Content Column -->
                            <div class="w-full md:w-1/2 h-auto md:h-full tech-slide-content flex items-center">
                                <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-0">
                                    <h2 class="mb-4 text-2xl sm:text-3xl md:text-4xl font-bold text-white">
                                        {{ $post['title'] }}
                                    </h2>

                                    <div class="tech-divider flex my-4 sm:my-6">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>

                                    <div class="space-y-3 sm:space-y-4 text-gray-200 text-sm sm:text-base">
                                        <p>{{ $post['summary'] }}</p>
                                        <p>This scientific approach eliminates guesswork, guaranteeing consistent
                                            quality and performance.</p>
                                    </div>

                                    <a href="{{ route('news.show', $post['slug']) }}"
                                        class="mt-6 sm:mt-8 inline-block px-4 sm:px-6 py-2 sm:py-3 bg-white/10 hover:bg-white/20 rounded-full text-xs sm:text-sm font-medium transition-all duration-300 hover:tracking-wider">
                                        Learn More →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Navigation dots - Positioned absolutely within the container -->
        <div class="tech-dots-container flex flex-col gap-3 sm:gap-4">
            @foreach ($posts as $index => $post)
                <button onclick="scrollToTechSection({{ $index }})"
                    class="w-2 h-2 sm:w-3 sm:h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white scale-150' : 'bg-white/20 hover:bg-white hover:scale-150' }}"
                    title="Go to section {{ $index + 1 }}">
                </button>
            @endforeach
        </div>

        <script>
            // Enhanced scrolling with better mobile support
            const techContainer = document.getElementById('tech-scroll-container');
            const techSections = document.querySelectorAll('#tech-scroll-container .scroll-section');
            const techDots = document.querySelectorAll('.tech-dots-container button');
            let isTechScrolling = false;
            let touchStartY = 0;

            function scrollToTechSection(index) {
                if (!isTechScrolling && techSections[index]) {
                    isTechScrolling = true;
                    techSections[index].scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    updateTechDots(index);
                    setTimeout(() => {
                        isTechScrolling = false;
                    }, 1000);
                }
            }

            function updateTechDots(index) {
                techDots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white', i === index);
                    dot.classList.toggle('scale-150', i === index);
                    dot.classList.toggle('bg-white/20', i !== index);
                    dot.classList.toggle('hover:bg-white', i !== index);
                    dot.classList.toggle('hover:scale-150', i !== index);
                });
            }

            // Touch support for mobile
            techContainer.addEventListener('touchstart', (e) => {
                touchStartY = e.touches[0].clientY;
            }, {
                passive: true
            });

            techContainer.addEventListener('touchmove', (e) => {
                if (!isTechScrolling) {
                    const touchY = e.touches[0].clientY;
                    const diff = touchStartY - touchY;
                    if (Math.abs(diff) > 50) { // threshold
                        const direction = diff > 0 ? 1 : -1;
                        const currentIndex = Math.round(techContainer.scrollTop / window.innerHeight);
                        const newIndex = Math.max(0, Math.min(currentIndex + direction, techSections.length - 1));
                        scrollToTechSection(newIndex);
                    }
                }
            }, {
                passive: true
            });

            // Update dots on scroll
            techContainer.addEventListener('scroll', () => {
                if (!isTechScrolling) {
                    const index = Math.round(techContainer.scrollTop / window.innerHeight);
                    updateTechDots(index);
                }
            }, {
                passive: true
            });

            // Initialize
            updateTechDots(0);
        </script>
    @else
        <div class="h-screen flex items-center justify-center p-4">
            <p class="text-neutral-400 text-center">No technology posts available at the moment.</p>
        </div>
    @endif
</div>
