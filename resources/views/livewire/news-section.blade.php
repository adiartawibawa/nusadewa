<div>
    <!-- Sorotan Utama -->
    @if ($featuredNews->count())
        <div class="mb-16">
            <h3 class="mb-6 text-2xl font-bold text-gray-800">Sorotan Utama</h3>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach ($featuredNews as $post)
                    <div
                        class="overflow-hidden transition bg-white border border-gray-100 shadow rounded-xl hover:shadow-lg">
                        @if ($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                alt="{{ $post->featured_image_caption }}" class="object-cover w-full h-48">
                        @else
                            <div class="flex items-center justify-center h-48 text-gray-500 bg-gray-200">
                                No Image
                            </div>
                        @endif
                        <div class="p-5">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($post->tags as $tag)
                                    <span wire:click="filterByTag('{{ $tag->slug }}')"
                                        class="px-2 py-1 text-xs font-medium text-blue-600 transition bg-blue-100 rounded-full cursor-pointer hover:bg-blue-200">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <h3 class="mb-2 text-xl font-bold text-gray-800">{{ $post->title }}</h3>
                            <p class="mb-4 text-gray-600 line-clamp-2">{{ $post->summary }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $post->published_at->format('d M Y') }} • {{ $post->read_time }}</span>
                                <a href="{{ route('news.show', $post->slug) }}" class="text-blue-600 hover:underline">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Filter Kontrol -->
    <div class="flex flex-col gap-4 mb-10 md:flex-row md:items-center md:justify-between">
        <!-- Filter Tags -->
        <div class="flex flex-wrap max-w-full gap-2 py-2 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300">
            <button wire:click="resetFilters"
                class="px-4 py-2 text-sm rounded-full transition
                    {{ !$selectedTag && !$selectedTopic && !$selectedCategory ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua Berita
            </button>
            @foreach ($topTags as $tag)
                <button wire:click="filterByTag('{{ $tag->slug }}')"
                    class="px-4 py-2 text-sm rounded-full transition whitespace-nowrap
                        {{ $selectedTag === $tag->slug ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $tag->name }}
                </button>
            @endforeach
        </div>

        <!-- Filter Topik -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200">
                Filter Topik
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 z-20 w-56 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg">
                @foreach ($topTopics as $topic)
                    <button wire:click="filterByTopic('{{ $topic->slug }}')" @click="open = false"
                        class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                        {{ $topic->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Daftar Berita Terbaru -->
    @if ($latestNews->count())
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($latestNews as $post)
                <div
                    class="overflow-hidden transition bg-white border border-gray-100 shadow rounded-xl hover:shadow-lg">
                    @if ($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                            alt="{{ $post->featured_image_caption }}" class="object-cover w-full h-48">
                    @else
                        <div class="flex items-center justify-center h-48 text-gray-500 bg-gray-200">
                            No Image
                        </div>
                    @endif
                    <div class="p-5">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach ($post->tags as $tag)
                                <span wire:click="filterByTag('{{ $tag->slug }}')"
                                    class="px-2 py-1 text-xs font-medium text-blue-600 transition bg-blue-100 rounded-full cursor-pointer hover:bg-blue-200">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-gray-800">{{ $post->title }}</h3>
                        <p class="mb-4 text-gray-600 line-clamp-2">{{ $post->summary }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $post->published_at->format('d M Y') }} • {{ $post->read_time }}</span>
                            <a href="{{ route('news.show', $post->slug) }}" class="text-blue-600 hover:underline">
                                Baca Selengkapnya →
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
        <div class="p-8 text-center bg-gray-100 rounded-lg">
            <p class="text-gray-600">Tidak ada berita ditemukan.</p>
            @if ($selectedTag || $selectedTopic || $selectedCategory)
                <button wire:click="resetFilters" class="mt-4 text-blue-600 hover:underline">
                    Reset Filter
                </button>
            @endif
        </div>
    @endif
</div>
