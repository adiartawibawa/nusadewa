<div x-data="{ active: 0 }" class="flex gap-2 h-[400px] max-w-6xl mx-auto">
    @foreach ($items as $i => $item)
        <div class="relative flex-1 overflow-hidden transition-all duration-500 ease-in-out shadow-md cursor-pointer rounded-2xl group hover:shadow-lg"
            :class="{ 'flex-[4]': active === {{ $i }}, 'flex-[1]': active !== {{ $i }} }"
            @mouseenter="active = {{ $i }}">
            <div class="relative w-full h-full">
                @if ($item['image'])
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}"
                        class="object-cover w-full h-full transition-transform duration-700 ease-in-out group-hover:scale-105">
                @else
                    <div class="flex items-center justify-center w-full h-full bg-gray-100 dark:bg-gray-800">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif

                {{-- Caption --}}
                <div class="absolute bottom-0 left-0 right-0 p-4 text-white bg-black/20 backdrop-blur-sm">
                    <h3 class="text-xl font-semibold">{{ $item['title'] }}</h3>
                    <p class="mt-1 text-sm line-clamp-2">{{ $item['summary'] }}</p>

                    @if (!empty($item['slug']) && !empty($linkPrefix))
                        <a href="{{ url($linkPrefix . '/' . $item['slug']) }}"
                            class="inline-block mt-2 text-sm font-medium text-blue-200 underline hover:text-blue-300">
                            {{ $labelLearnMore ?? __('Learn more') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- <div>
    how to use
    <x-accordion :items="$projects" linkPrefix="portfolio" labelLearnMore="Lihat detail" />
</div> --}}
