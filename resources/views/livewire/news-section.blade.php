<div class="py-8">
    <!-- Featured Highlights -->
    <div class="mb-16">
        <h3 class="mb-6 text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">
            {{ __('component.news_section.featured_highlights') }}
        </h3>

        <!-- SKELETON STATE -->
        {{-- <div class="grid gap-8 md:grid-cols-3" wire:loading>
            @for ($i = 0; $i < 3; $i++)
                <x-card :skeleton="true" />
            @endfor
        </div> --}}

        <!-- ACTUAL DATA -->
        <div class="grid gap-8 md:grid-cols-3" wire:loading.remove>
            @foreach ($featuredNews as $post)
                <x-card :item="$post" route="news.show" :featured="$post->is_featured" :read-time="$post->read_time" :tags="$post->tags"
                    tag-action="filterByTag" />
            @endforeach
        </div>
    </div>

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
    <div>
        <!-- SKELETON -->
        {{-- <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3" wire:loading>
            @for ($i = 0; $i < 15; $i++)
                <x-card :skeleton="true" />
            @endfor
        </div> --}}

        <!-- DATA -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3" wire:loading.remove>
            @foreach ($latestNews as $post)
                <x-card :item="$post" route="news.show" :featured="$post->is_featured" :read-time="$post->read_time" :tags="$post->tags"
                    tag-action="filterByTag" />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12" wire:loading.remove>
            {{ $latestNews->links() }}
        </div>

        <!-- Empty State -->
        @if ($latestNews->isEmpty())
            <div class="p-8 mt-6 text-center border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
                wire:loading.remove>
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
</div>
