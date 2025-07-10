<div>
    <div class="relative h-[80vh] min-h-[600px] overflow-hidden bg-transparent">
        <!-- Main Slider Structure -->
        <div class="relative w-full h-full">
            <!-- Navigation Arrows - Updated Position -->
            <button
                class="absolute z-10 flex items-center justify-center w-10 h-10 text-gray-900 transition-all duration-300 -translate-y-1/2 rounded-full shadow-lg opacity-0 left-4 top-1/2 bg-white/80 dark:bg-gray-800/80 dark:text-white hover:opacity-100 hover:scale-110 backdrop-blur-sm"
                aria-label="{{ __('component.team_slider.navigation.previous') }}">
                ◀
            </button>
            <button
                class="absolute z-10 flex items-center justify-center w-10 h-10 text-gray-900 transition-all duration-300 -translate-y-1/2 rounded-full shadow-lg opacity-0 right-4 top-1/2 bg-white/80 dark:bg-gray-800/80 dark:text-white hover:opacity-100 hover:scale-110 backdrop-blur-sm"
                aria-label="{{ __('component.team_slider.navigation.next') }}">
                ▶
            </button>

            <!-- Slider Content -->
            <div class="flex w-full h-full pb-16 overflow-x-auto team-slider-track scroll-smooth scrollbar-hide">
                @foreach ($teamMembers as $index => $member)
                    <div class="relative flex-shrink-0 w-full team-slide snap-start">
                        <div
                            class="flex flex-col w-full h-full gap-8 p-8 mx-auto team-slide-content max-w-7xl md:flex-row md:items-center md:gap-16">
                            <!-- Member Image -->
                            <div
                                class="team-member-image w-full h-[300px] rounded-xl overflow-hidden shadow-lg bg-gray-100 dark:bg-gray-700 md:flex-shrink-0 md:w-[45%] md:h-[400px]">
                                @if ($member->avatar)
                                    <img src="{{ Storage::url($member->avatar) }}" alt="{{ $member->name }}"
                                        loading="{{ $index < 2 ? 'eager' : 'lazy' }}"
                                        class="object-cover w-full h-full transition-transform duration-500 hover:scale-105">
                                @else
                                    <div
                                        class="flex items-center justify-center w-full h-full text-2xl text-gray-500 bg-gray-100 team-member-placeholder dark:bg-gray-700 dark:text-gray-400">
                                        <span>{{ __('component.team_slider.no_image') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Member Details -->
                            <div class="flex-1 text-gray-700 team-member-details dark:text-gray-200">
                                <span class="block mb-2 font-mono text-sm text-gray-500 dark:text-gray-400">
                                    {{ str_replace(':number', str_pad($loop->iteration, 2, '0', STR_PAD_LEFT), __('component.team_slider.team_counter')) }}
                                </span>
                                <h3 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white md:text-5xl">
                                    {{ $member->name }}</h3>
                                <p class="mb-6 text-xl font-medium text-blue-500">{{ $member->position }}</p>
                                <p class="mb-8 text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                                    {{ $member->bio }}
                                </p>

                                <!-- Social Links -->
                                @if (is_array($member->social_links) && count($member->social_links) > 0)
                                    <div class="flex gap-4 mb-8 team-member-social">
                                        @foreach ($member->social_links as $social)
                                            @if (!empty($social['url']) && !empty($social['platform']))
                                                <a href="{{ $social['url'] }}" target="_blank"
                                                    aria-label="{{ $social['platform'] }}"
                                                    class="flex items-center justify-center w-10 h-10 text-gray-500 transition-all rounded-full social-link dark:text-gray-400 hover:text-blue-500 hover:-translate-y-1">
                                                    <i
                                                        class="{{ $this->getSocialIcon($social['platform']) }} text-xl"></i>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Contact Button -->
                                <a href="#contact"
                                    class="inline-block px-6 py-3 font-medium text-white transition-all bg-blue-500 rounded-full team-contact-button hover:bg-blue-600 hover:-translate-y-1 hover:shadow-lg">
                                    {{ str_replace(':name', explode(' ', $member->name)[0], __('component.team_slider.contact_button')) }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Dots Navigation -->
            <div class="absolute z-10 flex gap-2 transform -translate-x-1/2 team-slider-dots bottom-6 left-1/2">
                @foreach ($teamMembers as $index => $member)
                    <button
                        class="team-dot w-2.5 h-2.5 rounded-full bg-gray-300 dark:bg-gray-600 transition-all {{ $loop->first ? '!bg-blue-500 scale-130' : '' }}"
                        aria-label="{{ str_replace(':name', $member->name, __('component.team_slider.navigation.go_to_member')) }}"
                        data-index="{{ $index }}"></button>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.team-slider-track');
            const slides = document.querySelectorAll('.team-slide');
            const dots = document.querySelectorAll('.team-dot');
            const prevBtn = document.querySelector(
                'button[aria-label="{{ __('component.team_slider.navigation.previous') }}"]');
            const nextBtn = document.querySelector(
                'button[aria-label="{{ __('component.team_slider.navigation.next') }}"]');
            let currentIndex = 0;
            let isScrolling = false;
            let scrollTimeout;

            // Show arrows on slider hover
            const sliderWrapper = document.querySelector('.team-slider-track');
            sliderWrapper.addEventListener('mouseenter', () => {
                prevBtn.style.opacity = '1';
                nextBtn.style.opacity = '1';
            });

            sliderWrapper.addEventListener('mouseleave', () => {
                prevBtn.style.opacity = '0';
                nextBtn.style.opacity = '0';
            });

            // Scroll to specific slide
            function goToSlide(index) {
                if (isScrolling || index < 0 || index >= slides.length) return;

                isScrolling = true;
                currentIndex = index;

                slides[index].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'start'
                });

                updateDots();

                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    isScrolling = false;
                }, 700);
            }

            // Update dot indicators
            function updateDots() {
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.add('!bg-blue-500', 'scale-130');
                        dot.classList.remove('bg-gray-300', 'dark:bg-gray-600');
                    } else {
                        dot.classList.remove('!bg-blue-500', 'scale-130');
                        dot.classList.add('bg-gray-300', 'dark:bg-gray-600');
                    }
                });
            }

            // Previous slide
            function prevSlide() {
                const newIndex = currentIndex === 0 ? slides.length - 1 : currentIndex - 1;
                goToSlide(newIndex);
            }

            // Next slide
            function nextSlide() {
                const newIndex = currentIndex === slides.length - 1 ? 0 : currentIndex + 1;
                goToSlide(newIndex);
            }

            // Handle dot clicks
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const index = parseInt(dot.getAttribute('data-index'));
                    goToSlide(index);
                });
            });

            // Handle arrow clicks
            prevBtn.addEventListener('click', prevSlide);
            nextBtn.addEventListener('click', nextSlide);

            // Handle keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prevSlide();
                if (e.key === 'ArrowRight') nextSlide();
            });

            // Detect scroll position to update dots
            slider.addEventListener('scroll', () => {
                if (!isScrolling) {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        const newIndex = Math.round(slider.scrollLeft / slider.offsetWidth);
                        if (newIndex !== currentIndex) {
                            currentIndex = newIndex;
                            updateDots();
                        }
                    }, 100);
                }
            });

            // Initialize
            updateDots();
        });
    </script>

    <style>
        /* Custom scrollbar hide */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Dot hover states */
        .team-dot:hover {
            transform: scale(1.3);
            background-color: rgb(59 130 246);
        }
    </style>
</div>
