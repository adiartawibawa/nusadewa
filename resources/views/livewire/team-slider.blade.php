<div x-data="sliderComponent()" x-init="initObserver()" x-intersect:enter="startAutoplay()" x-intersect:leave="stopAutoplay()"
    x-id="['slider']" class="relative h-[80vh] min-h-[600px] bg-transparent overflow-hidden">

    <!-- Arrows -->
    <button @click="prev"
        class="absolute z-10 flex items-center justify-center w-10 h-10 text-gray-900 transition -translate-y-1/2 rounded-full shadow-lg left-4 top-1/2 bg-white/80 dark:bg-gray-800/80 dark:text-white backdrop-blur-sm hover:scale-110 hover:opacity-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
    </button>

    <button @click="next"
        class="absolute z-10 flex items-center justify-center w-10 h-10 text-gray-900 transition -translate-y-1/2 rounded-full shadow-lg right-4 top-1/2 bg-white/80 dark:bg-gray-800/80 dark:text-white backdrop-blur-sm hover:scale-110 hover:opacity-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
    </button>

    <!-- Slider -->
    <div x-ref="track" class="flex w-full h-full overflow-x-auto snap-x snap-mandatory scroll-smooth scrollbar-hide">
        @foreach ($teamMembers as $index => $member)
            <div class="flex-shrink-0 w-full snap-start">
                <div class="flex flex-col items-center h-full gap-10 px-8 py-10 mx-auto max-w-7xl md:flex-row">

                    <!-- Image -->
                    <div
                        class="w-full md:w-[45%] h-[400px] rounded-xl overflow-hidden shadow-lg bg-gray-100 dark:bg-gray-700">
                        @if ($member['avatar'])
                            <img src="{{ Storage::url($member['avatar']) }}" alt="{{ $member['name'] }}"
                                class="object-cover w-full h-full transition-transform duration-500 hover:scale-105">
                        @else
                            <div
                                class="flex items-center justify-center w-full h-full text-2xl text-gray-500 dark:text-gray-400">
                                No image
                            </div>
                        @endif
                    </div>

                    <!-- Bio Content -->
                    <div class="w-full flex-1 flex flex-col h-[400px] relative group">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="font-mono text-sm text-gray-500 dark:text-gray-400">
                                {{ sprintf('%02d', $loop->iteration) }} / {{ count($teamMembers) }}
                            </span>

                            @if (!empty($member['social_links']))
                                <div class="flex gap-3 ml-auto">
                                    @foreach ($member['social_links'] as $platform => $url)
                                        <a href="{{ $url }}" target="_blank"
                                            aria-label="{{ ucfirst($platform) }}"
                                            class="text-gray-400 transition hover:text-blue-500">
                                            <i class="{{ $this->getSocialIcon($platform) }} text-xl"></i>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 pr-2 overflow-y-auto text-gray-700 dark:text-gray-200 scrollbar-hidden">
                            <h3 class="mb-2 text-3xl font-bold text-gray-900 md:text-5xl dark:text-white">
                                {{ $member['name'] }}
                            </h3>
                            <p class="mb-4 text-xl font-medium text-blue-500">
                                {{ $member['position'] }}
                            </p>
                            <p class="mb-6 text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                                {{ $member['bio'] }}
                            </p>

                            <a href="#contact"
                                class="inline-block w-full px-6 py-3 mt-auto font-medium text-white transition bg-blue-500 rounded-full hover:bg-blue-600 hover:-translate-y-1 hover:shadow-lg">
                                {{ __('Contact :name', ['name' => explode(' ', $member['name'])[0]]) }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Alpine Slider Component -->
<script>
    function sliderComponent() {
        return {
            index: 0,
            interval: null,
            startAutoplay() {
                if (!this.interval) {
                    this.interval = setInterval(() => this.next(), 5000);
                }
            },
            stopAutoplay() {
                clearInterval(this.interval);
                this.interval = null;
            },
            next() {
                this.index = (this.index + 1) % {{ count($teamMembers) }};
                this.scrollToSlide();
            },
            prev() {
                this.index = (this.index - 1 + {{ count($teamMembers) }}) % {{ count($teamMembers) }};
                this.scrollToSlide();
            },
            scrollToSlide() {
                const slide = this.$refs.track.children[this.index];
                if (slide) {
                    slide.scrollIntoView({
                        behavior: 'smooth',
                        inline: 'start'
                    });
                }
            },
            initObserver() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            this.startAutoplay();
                        } else {
                            this.stopAutoplay();
                        }
                    });
                }, {
                    threshold: 0.5
                }); // trigger when 50% visible

                observer.observe(this.$el);
            }
        };
    }
</script>

<!-- Scrollbar Styles -->
@push('styles')
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Only show scrollbar on hover */
        .scrollbar-hidden::-webkit-scrollbar {
            width: 6px;
            background-color: transparent;
        }

        .scrollbar-hidden::-webkit-scrollbar-thumb {
            background-color: transparent;
            border-radius: 3px;
        }

        .group:hover .scrollbar-hidden::-webkit-scrollbar-thumb {
            background-color: rgba(107, 114, 128, 0.5);
            /* gray-500/50 */
        }

        .group:hover .scrollbar-hidden {
            scrollbar-color: rgba(107, 114, 128, 0.5) transparent;
        }
    </style>
@endpush
