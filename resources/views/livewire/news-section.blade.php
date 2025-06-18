<section class="py-20 bg-white">
    <div class="container px-4 mx-auto">
        <div class="mb-16 text-center">
            <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">Berita & Pembaruan Terkini</h2>
            <div class="flex justify-center mx-auto my-6">
                <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
            </div>
            <p class="max-w-2xl mx-auto text-gray-600">Ikuti perkembangan terbaru penelitian dan inovasi akuakultur kami
            </p>
        </div>

        <!-- Berita Unggulan -->
        @if ($featuredNews->count() > 0)
            <div class="mb-16">
                <h3 class="mb-6 text-2xl font-bold text-gray-800">Sorotan Utama</h3>
                <div class="grid gap-8 md:grid-cols-3">
                    @foreach ($featuredNews as $post)
                        <div
                            class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:cursor-pointer">
                            @if ($post->featured_image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                                        alt="{{ $post->featured_image_caption }}" class="object-cover w-full h-full">
                                </div>
                            @else
                                <div class="flex items-center justify-center h-48 bg-gray-200">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach ($post->tags as $tag)
                                        <span wire:click="filterByTag('{{ $tag->slug }}')"
                                            class="px-2 py-1 text-xs font-medium text-blue-600 transition-colors bg-blue-100 rounded-full cursor-pointer hover:bg-blue-200">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <h3 class="mb-3 text-xl font-bold text-gray-800">{{ $post->title }}</h3>
                                <p class="mb-4 text-gray-600 line-clamp-2">{{ $post->summary }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ $post->published_at->format('d M Y') }} • {{ $post->read_time }}
                                    </span>
                                    <a href="{{ route('news.show', $post->slug) }}"
                                        class="text-sm font-medium text-primary hover:text-secondary">
                                        Baca Selengkapnya <i class="ml-1 fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Kontrol Filter -->
        <div class="flex flex-col items-center justify-between mb-8 space-y-4 md:flex-row md:space-y-0">
            <div class="flex flex-wrap justify-center gap-2">
                <button wire:click="resetFilters"
                    class="px-4 py-2 text-sm font-medium transition-colors rounded-full {{ !$selectedTag && !$selectedTopic && !$selectedCategory ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semua Berita
                </button>

                @foreach ($topTags as $tag)
                    <button wire:click="filterByTag('{{ $tag->slug }}')"
                        class="px-4 py-2 text-sm font-medium transition-colors rounded-full {{ $selectedTag === $tag->slug ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $tag->name }}
                    </button>
                @endforeach
            </div>

            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-full hover:bg-gray-200">
                    Filter berdasarkan Topik <i class="ml-2 fas fa-chevron-down"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-10 w-48 py-1 mt-2 bg-white border border-gray-200 rounded-md shadow-lg">
                    @foreach ($topTopics as $topic)
                        <button wire:click="filterByTopic('{{ $topic->slug }}')" @click="open = false"
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                            {{ $topic->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Daftar Berita Terbaru -->
        @if ($latestNews->count() > 0)
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($latestNews as $post)
                    <div
                        class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:cursor-pointer">
                        @if ($post->featured_image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                    alt="{{ $post->featured_image_caption }}" class="object-cover w-full h-full">
                            </div>
                        @else
                            <div class="flex items-center justify-center h-48 bg-gray-200">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($post->tags as $tag)
                                    <span wire:click="filterByTag('{{ $tag->slug }}')"
                                        class="px-2 py-1 text-xs font-medium text-blue-600 transition-colors bg-blue-100 rounded-full cursor-pointer hover:bg-blue-200">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <h3 class="mb-3 text-xl font-bold text-gray-800">{{ $post->title }}</h3>
                            <p class="mb-4 text-gray-600 line-clamp-2">{{ $post->summary }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    {{ $post->published_at->format('d M Y') }} • {{ $post->read_time }}
                                </span>
                                <a href="{{ route('news.show', $post->slug) }}"
                                    class="text-sm font-medium text-primary hover:text-secondary">
                                    Baca Selengkapnya <i class="ml-1 fas fa-arrow-right"></i>
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
                <p class="text-gray-600">Tidak ada berita yang ditemukan.</p>
                @if ($selectedTag || $selectedTopic || $selectedCategory)
                    <button wire:click="resetFilters" class="mt-4 text-primary hover:underline">
                        Reset filter
                    </button>
                @endif
            </div>
        @endif
    </div>
</section>
