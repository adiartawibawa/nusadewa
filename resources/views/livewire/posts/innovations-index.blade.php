<div>
    <div class="relative items-center bg-gray-900">
        <x-layouts.top-header />
        <x-layouts.main-nav />
    </div>

    <div class="bg-gray-50">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[['name' => 'Innovations', 'url' => route('innovations.index')]]" />

        <!-- Hero Section -->
        <div class="relative bg-indigo-900">
            <div class="absolute inset-0">
                <img class="object-cover w-full h-full" src="{{ asset('images/innovation-hero.jpg') }}" alt="">
                <div class="absolute inset-0 bg-indigo-900 mix-blend-multiply" aria-hidden="true"></div>
            </div>
            <div class="relative px-4 py-24 mx-auto max-w-7xl sm:py-32 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Our Innovations
                </h1>
                <p class="max-w-3xl mt-6 text-xl text-indigo-100">
                    Cutting-edge solutions and technological breakthroughs in shrimp breeding
                </p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container max-w-7xl px-4 py-12 mx-auto">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Search -->
                    <div class="mb-8">
                        <label for="search" class="sr-only">Search innovations</label>
                        <div class="relative">
                            <input wire:model.lazy="search" id="search" name="search" type="text"
                                class="block w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Search innovations...">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="p-6 mb-8 bg-white rounded-lg shadow">
                        <h3 class="mb-4 text-lg font-medium text-gray-900">Innovation Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($tags as $tag)
                                <button wire:click="filterByTag('{{ $tag->slug }}')" @class([
                                    'px-3 py-1 text-sm rounded-full transition-colors',
                                    'bg-indigo-100 text-indigo-800' => $selectedTag === $tag->slug,
                                    'bg-gray-100 text-gray-800 hover:bg-gray-200' =>
                                        $selectedTag !== $tag->slug,
                                ])>
                                    #{{ $tag->name }}
                                </button>
                            @endforeach
                        </div>
                        @if ($selectedTag)
                            <button wire:click="resetFilters"
                                class="mt-3 text-sm text-indigo-600 hover:text-indigo-800">
                                Clear tag filter
                            </button>
                        @endif
                    </div>

                    <!-- Topics -->
                    <div class="p-6 bg-white rounded-lg shadow">
                        <h3 class="mb-4 text-lg font-medium text-gray-900">Topics</h3>
                        <div class="space-y-2">
                            @foreach ($topics as $topic)
                                <button wire:click="filterByTopic('{{ $topic->slug }}')" @class([
                                    'flex items-center w-full px-3 py-2 text-sm rounded-lg transition-colors',
                                    'bg-indigo-50 text-indigo-800' => $selectedTopic === $topic->slug,
                                    'bg-gray-50 text-gray-800 hover:bg-gray-100' =>
                                        $selectedTopic !== $topic->slug,
                                ])>
                                    <span>{{ $topic->name }}</span>
                                    <span class="ml-auto text-xs text-gray-500">{{ $topic->posts_count }}</span>
                                </button>
                            @endforeach
                        </div>
                        @if ($selectedTopic)
                            <button wire:click="resetFilters"
                                class="mt-3 text-sm text-indigo-600 hover:text-indigo-800">
                                Clear topic filter
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Innovation List -->
                <div class="mt-12 lg:col-span-2 lg:mt-0">
                    <!-- Featured Innovations -->
                    @if ($featuredInnovations->count() > 0)
                        <div class="mb-12">
                            <h2 class="mb-6 text-2xl font-bold text-gray-900">Featured Innovations</h2>
                            <div class="grid gap-6 md:grid-cols-2">
                                @foreach ($featuredInnovations as $innovation)
                                    <div
                                        class="overflow-hidden transition-all bg-white border border-gray-200 rounded-xl hover:shadow-lg">
                                        <div class="h-48 overflow-hidden">
                                            <img src="{{ $innovation->featured_image_url }}"
                                                alt="{{ $innovation->title }}" class="object-cover w-full h-full">
                                        </div>
                                        <div class="p-6">
                                            <div class="flex flex-wrap gap-2 mb-3">
                                                @foreach ($innovation->tags->take(3) as $tag)
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-full">
                                                        #{{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            <h3 class="mb-2 text-xl font-bold text-gray-900">
                                                <a href="{{ route('innovations.show', $innovation->slug) }}"
                                                    class="hover:text-indigo-600">
                                                    {{ $innovation->title }}
                                                </a>
                                            </h3>
                                            <p class="mb-4 text-gray-600 line-clamp-2">{{ $innovation->summary }}</p>
                                            <a href="{{ route('innovations.show', $innovation->slug) }}"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                                Read more <i class="ml-1 fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- All Innovations -->
                    <h2 class="mb-6 text-2xl font-bold text-gray-900">All Innovations</h2>

                    @if ($innovations->count() > 0)
                        <div class="grid gap-6 md:grid-cols-2">
                            @foreach ($innovations as $innovation)
                                <div
                                    class="overflow-hidden transition-all bg-white border border-gray-200 rounded-xl hover:shadow-lg">
                                    <div class="h-48 overflow-hidden">
                                        <img src="{{ $innovation->featured_image_url }}"
                                            alt="{{ $innovation->title }}" class="object-cover w-full h-full">
                                    </div>
                                    <div class="p-6">
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            @foreach ($innovation->tags->take(3) as $tag)
                                                <span
                                                    class="px-2 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-full">
                                                    #{{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <h3 class="mb-2 text-xl font-bold text-gray-900">
                                            <a href="{{ route('innovations.show', $innovation->slug) }}"
                                                class="hover:text-indigo-600">
                                                {{ $innovation->title }}
                                            </a>
                                        </h3>
                                        <p class="mb-4 text-gray-600 line-clamp-2">{{ $innovation->summary }}</p>
                                        <div class="flex items-center justify-between">
                                            <time class="text-sm text-gray-500">
                                                {{ $innovation->published_at->format('M j, Y') }}
                                            </time>
                                            <a href="{{ route('innovations.show', $innovation->slug) }}"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                                Read more
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $innovations->links() }}
                        </div>
                    @else
                        <div class="p-8 text-center bg-white rounded-xl">
                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No innovations found</h3>
                            <p class="mt-2 text-gray-500">
                                @if ($selectedTag || $selectedTopic || $search)
                                    Try removing some filters or search terms
                                    <button wire:click="resetFilters"
                                        class="mt-2 text-indigo-600 hover:text-indigo-800">
                                        Reset all filters
                                    </button>
                                @else
                                    Check back later for new innovations
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
