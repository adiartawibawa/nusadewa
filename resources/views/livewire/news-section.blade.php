<div class="py-8 ">
    <!-- Featured Highlights -->
    @if ($featuredNews->count())
        <div class="mb-16">
            <h3 class="mb-6 text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">
                {{ __('component.news_section.featured_highlights') }}
            </h3>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach ($featuredNews as $post)
                    <div
                        class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm dark:bg-gray-800 dark:border-gray-700 rounded-xl hover:shadow-md hover:border-blue-100 dark:hover:border-blue-900/50">
                        @if ($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                alt="{{ $post->featured_image_caption ?? __('component.news_section.default_image_alt') }}"
                                class="object-cover w-full h-48" loading="lazy">
                        @else
                            <div class="flex items-center justify-center h-48 text-gray-400 bg-gray-50 dark:bg-gray-700">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                        <div class="p-5">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($post->tags as $tag)
                                    <button wire:click="filterByTag('{{ $tag->slug }}')"
                                        class="px-2 py-1 text-xs font-medium text-blue-600 transition-all duration-200 rounded-full dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30">
                                        {{ $tag->name }}
                                    </button>
                                @endforeach
                            </div>
                            <h3
                                class="mb-2 text-xl font-bold text-gray-800 transition-colors dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                                <a href="{{ route('news.show', $post->slug) }}"
                                    class="rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">{{ $post->summary }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ $post->published_at->format('M d, Y') }} • {{ $post->read_time }}</span>
                                <a href="{{ route('news.show', $post->slug) }}"
                                    class="font-medium text-blue-600 transition-colors rounded dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ __('component.news_section.read_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Filter Controls -->
    <div class="flex flex-col gap-4 mb-12 md:flex-row md:items-center md:justify-between">
        <!-- Tag Filters -->
        <div
            class="flex flex-wrap max-w-full gap-2 py-2 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600">
            <button wire:click="resetFilters"
                class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-200
                    {{ !$selectedTag && !$selectedTopic && !$selectedCategory ? 'bg-blue-600 dark:bg-blue-700 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                {{ __('component.news_section.all_news') }}
            </button>
            @foreach ($topTags as $tag)
                <button wire:click="filterByTag('{{ $tag->slug }}')"
                    class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-200 whitespace-nowrap
                        {{ $selectedTag === $tag->slug ? 'bg-blue-600 dark:bg-blue-700 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    {{ $tag->name }}
                </button>
            @endforeach
        </div>

        <!-- Topic Filter -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-gray-100 rounded-full dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                aria-expanded="false" :aria-expanded="open.toString()">
                {{ __('component.news_section.filter_by_topic') }}
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 z-20 w-56 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700"
                role="menu">
                @foreach ($topTopics as $topic)
                    <button wire:click="filterByTopic('{{ $topic->slug }}')" @click="open = false"
                        class="w-full px-4 py-2 text-sm text-left text-gray-700 transition-colors dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700"
                        role="menuitem">
                        {{ $topic->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Latest News -->
    @if ($latestNews->count())
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($latestNews as $post)
                <div
                    class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm dark:bg-gray-800 dark:border-gray-700 rounded-xl hover:shadow-md hover:border-blue-100 dark:hover:border-blue-900/50">
                    @if ($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                            alt="{{ $post->featured_image_caption ?? __('component.news_section.default_image_alt') }}"
                            class="object-cover w-full h-48" loading="lazy">
                    @else
                        <div class="flex items-center justify-center h-48 text-gray-400 bg-gray-50 dark:bg-gray-700">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach ($post->tags as $tag)
                                <button wire:click="filterByTag('{{ $tag->slug }}')"
                                    class="px-2 py-1 text-xs font-medium text-blue-600 transition-all duration-200 rounded-full dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30">
                                    {{ $tag->name }}
                                </button>
                            @endforeach
                        </div>
                        <h3
                            class="mb-2 text-xl font-bold text-gray-800 transition-colors dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                            <a href="{{ route('news.show', $post->slug) }}"
                                class="rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">{{ $post->summary }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                            <span>{{ $post->published_at->format('M d, Y') }} • {{ $post->read_time }}</span>
                            <a href="{{ route('news.show', $post->slug) }}"
                                class="font-medium text-blue-600 transition-colors rounded dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                {{ __('component.news_section.read_more') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $latestNews->links() }}
        </div>
    @else
        <div class="p-8 text-center border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
            <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="mt-4 text-gray-600 dark:text-gray-400">
                {{ __('component.news_section.no_articles') }}
            </p>
            @if ($selectedTag || $selectedTopic || $selectedCategory)
                <button wire:click="resetFilters"
                    class="mt-4 font-medium text-blue-600 transition-colors rounded dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ __('component.news_section.reset_filters') }}
                </button>
            @endif
        </div>
    @endif
</div>
