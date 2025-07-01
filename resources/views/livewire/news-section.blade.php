<div class="py-8">
    <!-- Featured Highlights -->
    @if ($featuredNews->count())
        <div class="mb-16">
            <h3 class="mb-6 text-2xl font-bold text-gray-800 md:text-3xl">Featured Highlights</h3>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach ($featuredNews as $post)
                    <div
                        class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-blue-100">
                        @if ($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                alt="{{ $post->featured_image_caption }}" class="object-cover w-full h-48">
                        @else
                            <div class="flex items-center justify-center h-48 text-gray-400 bg-gray-50">
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
                                        class="px-2 py-1 text-xs font-medium transition-all duration-200 text-blue-600 bg-blue-50 rounded-full hover:bg-blue-100">
                                        {{ $tag->name }}
                                    </button>
                                @endforeach
                            </div>
                            <h3 class="mb-2 text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors">
                                <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="mb-4 text-gray-600 line-clamp-2">{{ $post->summary }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $post->published_at->format('M d, Y') }} • {{ $post->read_time }}</span>
                                <a href="{{ route('news.show', $post->slug) }}"
                                    class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                                    Read More →
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
        <div class="flex flex-wrap max-w-full gap-2 py-2 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300">
            <button wire:click="resetFilters"
                class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-200
                    {{ !$selectedTag && !$selectedTopic && !$selectedCategory ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All News
            </button>
            @foreach ($topTags as $tag)
                <button wire:click="filterByTag('{{ $tag->slug }}')"
                    class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-200 whitespace-nowrap
                        {{ $selectedTag === $tag->slug ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $tag->name }}
                </button>
            @endforeach
        </div>

        <!-- Topic Filter -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-gray-100 rounded-full hover:bg-gray-200">
                Filter by Topic
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 z-20 w-56 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg">
                @foreach ($topTopics as $topic)
                    <button wire:click="filterByTopic('{{ $topic->slug }}')" @click="open = false"
                        class="w-full px-4 py-2 text-sm text-left transition-colors text-gray-700 hover:bg-gray-100">
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
                    class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-blue-100">
                    @if ($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                            alt="{{ $post->featured_image_caption }}" class="object-cover w-full h-48">
                    @else
                        <div class="flex items-center justify-center h-48 text-gray-400 bg-gray-50">
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
                                    class="px-2 py-1 text-xs font-medium transition-all duration-200 text-blue-600 bg-blue-50 rounded-full hover:bg-blue-100">
                                    {{ $tag->name }}
                                </button>
                            @endforeach
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors">
                            <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <p class="mb-4 text-gray-600 line-clamp-2">{{ $post->summary }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $post->published_at->format('M d, Y') }} • {{ $post->read_time }}</span>
                            <a href="{{ route('news.show', $post->slug) }}"
                                class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                                Read More →
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
        <div class="p-8 text-center bg-gray-50 rounded-lg border border-gray-200">
            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="mt-4 text-gray-600">No articles found matching your criteria</p>
            @if ($selectedTag || $selectedTopic || $selectedCategory)
                <button wire:click="resetFilters"
                    class="mt-4 font-medium text-blue-600 hover:text-blue-500 transition-colors">
                    Reset Filters
                </button>
            @endif
        </div>
    @endif
</div>
