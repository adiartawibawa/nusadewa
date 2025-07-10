<div class="relative">
    <div class="container flex items-center">
        <!-- Left Navigation -->
        @if ($totalInnovations > 1)
            <div class="hidden mr-4 md:flex">
                <button wire:click="previous"
                    class="p-3 text-white transition-all duration-300 transform bg-blue-500 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none hover:scale-110"
                    aria-label="{{ __('component.innovations_carousel.navigation.previous') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Cards Container -->
        <div class="flex-1 relative h-[400px] md:h-[500px] w-full overflow-hidden" x-data>
            @foreach ($cards as $card)
                <div wire:click="selectCard({{ array_search($card['data']['id'], array_column($innovations, 'id')) }})"
                    class="absolute top-1/2 left-1/2 w-full max-w-md p-6 bg-white rounded-xl shadow-lg cursor-pointer card transition-all duration-700 ease-[cubic-bezier(0.25,0.1,0.25,1)]"
                    style="
                        transform: translate(-50%, -50%)
                                 translateX(calc({{ $card['position'] }} * 8rem))
                                 scale({{ $card['scale'] }});
                        z-index: {{ $card['zIndex'] }};
                        opacity: {{ $card['opacity'] }};
                        transition-delay: {{ abs($card['position']) * 50 }}ms;
                        @if ($card['position'] == 0) box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                        @else
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); @endif
                    "
                    x-intersect:enter="$el.style.opacity = '{{ $card['opacity'] }}'"
                    x-intersect:leave="$el.style.opacity = '0'">
                    <div class="h-48 mb-4 overflow-hidden rounded-lg">
                        @if ($card['data']['featured_image'])
                            <img src="{{ asset('storage/' . $card['data']['featured_image']) }}"
                                alt="{{ $card['data']['title'] ?? __('component.innovations_carousel.default_image_alt') }}"
                                class="object-cover w-full h-full transition-transform duration-300 hover:scale-105">
                        @else
                            <div class="flex items-center justify-center w-full h-full bg-gray-100">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <h3
                        class="mb-2 text-lg font-semibold text-gray-800 @if ($card['position'] == 0) font-bold @endif">
                        {{ $card['data']['title'] }}
                    </h3>
                    <p class="text-sm text-gray-600 line-clamp-2">
                        {{ $card['data']['summary'] }}
                    </p>
                    @if ($card['position'] == 0)
                        <a href="{{ route('innovations.show', $card['data']['slug']) }}"
                            class="inline-block mt-3 text-blue-500 hover:text-blue-600">
                            {{ __('component.innovations_carousel.learn_more') }}
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Right Navigation -->
        @if ($totalInnovations > 1)
            <div class="hidden ml-4 md:flex">
                <button wire:click="next"
                    class="p-3 text-white transition-all duration-300 transform bg-blue-500 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none hover:scale-110"
                    aria-label="{{ __('component.innovations_carousel.navigation.next') }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Mobile Navigation -->
    @if ($totalInnovations > 1)
        <div class="flex items-center justify-center mt-8 space-x-4 md:hidden">
            <button wire:click="previous"
                class="p-2 text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none"
                aria-label="{{ __('component.innovations_carousel.navigation.previous') }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="flex space-x-2">
                @foreach ($innovations as $index => $innovation)
                    <button wire:click="selectCard({{ $index }})"
                        class="w-3 h-3 rounded-full transition-all duration-300 {{ $index == $currentIndex ? 'bg-blue-500 w-6' : 'bg-gray-300' }}"
                        aria-label="{{ __('component.innovations_carousel.navigation.go_to_card', ['number' => $index + 1]) }}">
                    </button>
                @endforeach
            </div>

            <button wire:click="next"
                class="p-2 text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none"
                aria-label="{{ __('component.innovations_carousel.navigation.next') }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    @endif

    <style>
        .card {
            transition-property: transform, opacity, box-shadow;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 700ms;
            transform-style: preserve-3d;
            will-change: transform, opacity;
        }

        .card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.15) !important;
        }

        .center-card {
            transform: translate(-50%, -50%) scale(1) !important;
            opacity: 1 !important;
            cursor: default;
        }

        @media (min-width: 768px) {
            .container {
                max-width: 1200px;
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
    </style>
</div>
