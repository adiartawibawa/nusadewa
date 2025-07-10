<div class="dark:bg-gray-900">
    <div class="relative items-center bg-gray-900 dark:bg-gray-800">
        <x-layouts.top-header />
        <x-layouts.main-nav />
    </div>

    <div class="bg-gray-50 dark:bg-gray-900">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[['name' => 'Innovations', 'url' => route('innovations.index')]]" />

        <!-- Hero Section -->
        <div class="relative bg-indigo-900 dark:bg-indigo-950">
            <div class="relative px-4 py-24 mx-auto max-w-7xl sm:py-32 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    {{ __('component.innovations.page_title') }}
                </h1>
                <p class="max-w-3xl mt-6 text-xl text-indigo-100 dark:text-indigo-200">
                    {{ __('component.innovations.page_subtitle') }}
                </p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container px-4 py-12 mx-auto max-w-7xl">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Search -->
                    <div class="mb-8">
                        <label for="search"
                            class="sr-only">{{ __('component.innovations.search_placeholder') }}</label>
                        <div class="relative">
                            <input wire:model.lazy="search" id="search" name="search" type="text"
                                class="block w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                                placeholder="{{ __('component.innovations.search_placeholder') }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="p-6 mb-8 bg-white rounded-lg shadow dark:bg-gray-800">
                        <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('component.innovations.tags_title') }}
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($tags as $tag)
                                <button wire:click="filterByTag('{{ $tag->slug }}')" @class([
                                    'px-3 py-1 text-sm rounded-full transition-colors',
                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300' =>
                                        $selectedTag === $tag->slug,
                                    'bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600' =>
                                        $selectedTag !== $tag->slug,
                                ])>
                                    #{{ $tag->name }}
                                </button>
                            @endforeach
                        </div>
                        @if ($selectedTag)
                            <button wire:click="resetFilters"
                                class="mt-3 text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                                {{ __('component.innovations.clear_tag_filter') }}
                            </button>
                        @endif
                    </div>

                    <!-- Topics -->
                    <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                        <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('component.innovations.topics_title') }}
                        </h3>
                        <div class="space-y-2">
                            @foreach ($topics as $topic)
                                <button wire:click="filterByTopic('{{ $topic->slug }}')" @class([
                                    'flex items-center w-full px-3 py-2 text-sm rounded-lg transition-colors',
                                    'bg-indigo-50 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300' =>
                                        $selectedTopic === $topic->slug,
                                    'bg-gray-50 text-gray-800 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600' =>
                                        $selectedTopic !== $topic->slug,
                                ])>
                                    <span>{{ $topic->name }}</span>
                                    <span
                                        class="ml-auto text-xs text-gray-500 dark:text-gray-400">{{ $topic->posts_count }}</span>
                                </button>
                            @endforeach
                        </div>
                        @if ($selectedTopic)
                            <button wire:click="resetFilters"
                                class="mt-3 text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                                {{ __('component.innovations.clear_topic_filter') }}
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Innovation List -->
                <div class="mt-12 lg:col-span-2 lg:mt-0">
                    <!-- Featured Innovations -->
                    @if ($featuredInnovations->count() > 0)
                        <div class="mb-12">
                            <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
                                {{ __('component.innovations.featured_innovations') }}
                            </h2>
                            <div class="grid gap-6 md:grid-cols-2">
                                @foreach ($featuredInnovations as $innovation)
                                    <div
                                        class="overflow-hidden transition-all bg-white border border-gray-200 rounded-xl hover:shadow-lg dark:bg-gray-800 dark:border-gray-700 dark:hover:shadow-gray-700/50">
                                        <div class="h-48 overflow-hidden">
                                            <img src="{{ $innovation->featured_image_url }}"
                                                alt="{{ $innovation->title }}" class="object-cover w-full h-full">
                                        </div>
                                        <div class="p-6">
                                            <div class="flex flex-wrap gap-2 mb-3">
                                                @foreach ($innovation->tags->take(3) as $tag)
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium text-indigo-600 rounded-full bg-indigo-50 dark:text-indigo-300 dark:bg-indigo-900/50">
                                                        #{{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">
                                                <a href="{{ route('innovations.show', $innovation->slug) }}"
                                                    class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                                    {{ $innovation->title }}
                                                </a>
                                            </h3>
                                            <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">
                                                {{ $innovation->summary }}</p>
                                            <a href="{{ route('innovations.show', $innovation->slug) }}"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                {{ __('component.innovations.read_more') }} <i
                                                    class="ml-1 fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- All Innovations -->
                    <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
                        {{ __('component.innovations.all_innovations') }}
                    </h2>

                    @if ($innovations->count() > 0)
                        <div class="grid gap-6 md:grid-cols-2">
                            @foreach ($innovations as $innovation)
                                <div
                                    class="overflow-hidden transition-all bg-white border border-gray-200 rounded-xl hover:shadow-lg dark:bg-gray-800 dark:border-gray-700 dark:hover:shadow-gray-700/50">
                                    <div class="h-48 overflow-hidden">
                                        <img src="{{ $innovation->featured_image_url }}"
                                            alt="{{ $innovation->title }}" class="object-cover w-full h-full">
                                    </div>
                                    <div class="p-6">
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            @foreach ($innovation->tags->take(3) as $tag)
                                                <span
                                                    class="px-2 py-1 text-xs font-medium text-indigo-600 rounded-full bg-indigo-50 dark:text-indigo-300 dark:bg-indigo-900/50">
                                                    #{{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">
                                            <a href="{{ route('innovations.show', $innovation->slug) }}"
                                                class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                                {{ $innovation->title }}
                                            </a>
                                        </h3>
                                        <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">
                                            {{ $innovation->summary }}</p>
                                        <div class="flex items-center justify-between">
                                            <time class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $innovation->published_at->format('M j, Y') }}
                                            </time>
                                            <a href="{{ route('innovations.show', $innovation->slug) }}"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                {{ __('component.innovations.read_more') }}
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
                        <div class="p-8 text-center bg-white rounded-xl dark:bg-gray-800">
                            <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                                {{ __('component.innovations.no_innovations') }}
                            </h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                @if ($selectedTag || $selectedTopic || $search)
                                    {{ __('component.innovations.no_innovations_suggestion') }}
                                    <button wire:click="resetFilters"
                                        class="mt-2 text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        {{ __('component.innovations.reset_filters') }}
                                    </button>
                                @else
                                    {{ __('component.innovations.check_back_later') }}
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
