<div class="relative group h-[80vh]">
    <!-- Arrows -->
    <button id="prev"
        class="absolute z-10 p-2 transition-opacity duration-300 -translate-y-1/2 rounded-full shadow-md opacity-0 left-4 top-1/2 bg-white/70 hover:bg-white group-hover:opacity-100">
        ◀
    </button>
    <button id="next"
        class="absolute z-10 p-2 transition-opacity duration-300 -translate-y-1/2 rounded-full shadow-md opacity-0 right-4 top-1/2 bg-white/70 hover:bg-white group-hover:opacity-100">
        ▶
    </button>

    <!-- Scroll container -->
    <div
        class="flex w-full h-full overflow-x-auto overflow-y-hidden scroll-container flex-nowrap no-scrollbar snap-x snap-mandatory">
        @foreach ($teamMembers as $index => $member)
            <section
                class="relative flex flex-col items-center justify-center flex-shrink-0 w-full h-full p-8 scroll-section snap-start md:flex-row">
                <div class="flex flex-col items-center w-full max-w-6xl gap-12 mx-auto md:flex-row">
                    <!-- Image Section -->
                    <div class="relative w-full overflow-hidden md:w-1/2 h-96 group rounded-2xl">
                        @if ($member->avatar)
                            <img src="{{ Storage::url($member->avatar) }}" alt="{{ $member->name }}"
                                class="absolute inset-0 object-cover w-full h-full transition-all duration-1000 group-hover:scale-110">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center bg-neutral-800">
                                <span class="text-4xl text-neutral-500">No Image</span>
                            </div>
                        @endif
                        <div
                            class="absolute inset-0 transition-opacity duration-500 bg-gradient-to-t from-neutral-950/70 via-neutral-950/40 to-neutral-950/10 group-hover:opacity-0">
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="w-full md:w-1/2">
                        <span
                            class="font-mono text-sm tracking-wider text-neutral-400">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            / TEAM</span>
                        <h2 class="mt-4 text-4xl font-bold leading-tight text-gray-800 md:text-6xl">{{ $member->name }}
                        </h2>
                        <p class="mt-2 text-lg font-medium text-blue-400">{{ $member->position }}</p>
                        <p class="mt-6 text-lg leading-relaxed text-gray-600">{{ $member->bio }}</p>

                        <!-- Social Links -->
                        @if (is_array($member->social_links) && count($member->social_links) > 0)
                            <div class="flex gap-4 mt-6">
                                @foreach ($member->social_links as $social)
                                    @if (!empty($social['url']) && !empty($social['platform']))
                                        <a href="{{ $social['url'] }}" target="_blank"
                                            class="text-gray-500 hover:text-blue-500">
                                            <span class="sr-only">{{ $social['platform'] }}</span>
                                            <i class="{{ $this->getSocialIcon($social['platform']) }} text-xl"></i>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <!-- Contact Button -->
                        <div class="flex gap-4 mt-8">
                            <a href="#contact"
                                class="px-6 py-3 text-sm font-medium text-white transition-all duration-300 bg-blue-600 rounded-full hover:bg-blue-700 hover:tracking-wider">
                                Contact {{ explode(' ', $member->name)[0] }}
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    </div>

    <!-- Dots Navigation -->
    <div class="absolute z-10 flex gap-3 -translate-x-1/2 dot-container bottom-8 left-1/2">
        @foreach ($teamMembers as $index => $member)
            <button onclick="scrollToSection({{ $index }})" title="Go to {{ $member->name }}"
                class="w-3 h-3 rounded-full transition-all duration-300 {{ $loop->first ? 'bg-blue-500 scale-150' : 'bg-white/20 hover:bg-white hover:scale-150' }}"></button>
        @endforeach
    </div>
</div>

@push('styles')
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .snap-x {
            scroll-snap-type: x mandatory;
        }

        .snap-start {
            scroll-snap-align: start;
        }
    </style>
@endpush

@push('scripts')
    <script>
        const container = document.querySelector('.scroll-container');
        const dots = document.querySelectorAll('.dot-container button');
        let currentIndex = 0;
        let isScrolling = false;
        let scrollTimeout;

        function scrollToSection(index) {
            if (!isScrolling) {
                isScrolling = true;
                currentIndex = index;
                const sections = document.querySelectorAll('.scroll-section');
                sections[index].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'start'
                });
                updateDots(index);

                // Reset isScrolling after animation completes
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    isScrolling = false;
                }, 700);
            }
        }

        function updateDots(index) {
            dots.forEach((dot, i) => {
                dot.className = `w-3 h-3 rounded-full transition-all duration-300 ${
                i === index ? 'bg-blue-500 scale-150' : 'bg-white/20 hover:bg-white hover:scale-150'
            }`;
            });
        }

        // Prev/Next navigation with wrap-around
        document.getElementById('prev')?.addEventListener('click', () => {
            const sections = document.querySelectorAll('.scroll-section');
            const newIndex = currentIndex === 0 ? sections.length - 1 : currentIndex - 1;
            scrollToSection(newIndex);
        });

        document.getElementById('next')?.addEventListener('click', () => {
            const sections = document.querySelectorAll('.scroll-section');
            const newIndex = currentIndex === sections.length - 1 ? 0 : currentIndex + 1;
            scrollToSection(newIndex);
        });

        // Update dots on manual scroll with debounce
        container?.addEventListener('scroll', () => {
            if (!isScrolling) {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    const index = Math.round(container.scrollLeft / container.offsetWidth);
                    if (index !== currentIndex) {
                        currentIndex = index;
                        updateDots(index);
                    }
                }, 100);
            }
        });

        // Handle keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                document.getElementById('prev')?.click();
            } else if (e.key === 'ArrowRight') {
                document.getElementById('next')?.click();
            }
        });
    </script>
@endpush
