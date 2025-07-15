@props([
    'items' => [],
    'linkPrefix' => 'innovations',
    'labelLearnMore' => __('Learn more'),
    'interval' => 4000,
])

<div x-data="carousel({ slides: @js($items), interval: {{ $interval }} })" x-init="start()"
    class="relative w-full max-w-6xl mx-auto h-[500px] px-6 overflow-hidden">

    <template x-for="(slide, i) in slides" :key="i">
        <div @click="goTo(i)"
            class="absolute w-full max-w-xl p-6 transition-all duration-700 ease-in-out cursor-pointer top-1/2 left-1/2"
            :style="getStyles(i)">

            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 rounded-xl">
                <div class="flex items-center justify-center w-full h-48 overflow-hidden bg-gray-100 dark:bg-gray-800">
                    <template x-if="slide.image">
                        <img :src="'/storage/' + slide.image" :alt="slide.title"
                            class="object-cover w-full h-full transition-transform duration-300 hover:scale-105">
                    </template>
                    <template x-if="!slide.image">
                        <div class="flex items-center justify-center w-full h-full">
                            <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </template>
                </div>

                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white" x-text="slide.title"></h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-2" x-text="slide.summary"></p>
                    <a :href="'/' + '{{ $linkPrefix }}' + '/' + slide.slug"
                        class="inline-block mt-3 text-blue-500 transition hover:text-blue-700 dark:hover:text-blue-300">
                        {{ $labelLearnMore }}
                    </a>
                </div>
            </div>
        </div>
    </template>

    <div class="absolute inset-x-0 z-10 flex justify-center space-x-2 bottom-6">
        <template x-for="(slide, i) in slides" :key="i">
            <button @click="goTo(i)" :class="active === i ? 'w-6 bg-blue-600' : 'w-3 bg-gray-400'"
                class="h-3 transition-all duration-300 rounded-full"></button>
        </template>
    </div>
</div>

<script>
    function carousel({
        slides = [],
        interval = 5000
    }) {
        return {
            slides,
            active: 0,
            timer: null,

            start() {
                this.timer = setInterval(() => this.next(), interval);
            },

            stop() {
                clearInterval(this.timer);
            },

            goTo(index) {
                this.active = index;
                this.stop();
                this.start();
            },

            next() {
                this.active = (this.active + 1) % this.slides.length;
            },

            getStyles(index) {
                const total = this.slides.length;
                let pos = (index - this.active + total) % total;

                if (pos > total / 2) pos -= total;

                const translateX = pos * 8;
                const scale = 1 - Math.min(Math.abs(pos) * 0.1, 0.2);
                const z = 30 - Math.abs(pos) * 5;

                return `
                    transform: translate(-50%, -50%) translateX(${translateX}rem) scale(${scale});
                    z-index: ${z};
                    opacity: 1;
                `;
            }
        };
    }
</script>
