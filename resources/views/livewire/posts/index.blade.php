<div class="dark:bg-gray-900">
    <div class="relative items-center bg-gray-900 dark:bg-gray-800">
        <!-- Header Top -->
        <x-layouts.top-header />

        <!-- Main Navigation -->
        <x-layouts.main-nav />
    </div>

    <div class="bg-gray-50 dark:bg-gray-900">
        <!-- Page Header -->
        <div class="py-16 bg-gradient-to-r from-blue-900 to-indigo-800 dark:from-blue-950 dark:to-indigo-900">
            <div class="container px-4 mx-auto">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl font-bold text-white md:text-5xl">
                        {{ __('component.news.page_title') }}
                    </h1>
                    <p class="mt-4 text-xl text-blue-100 dark:text-blue-200">
                        {{ __('component.news.page_subtitle') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[['name' => 'News', 'url' => route('news.index')]]" />

        <!-- Main Content -->
        <div class="container px-4 pb-12 mx-auto max-w-7xl">
            <div class="flex flex-col gap-8 lg:flex-row">
                <!-- Main Content (75% width on large screens) -->
                <div class="lg:w-3/4">
                    <!-- Filter Indicator -->
                    @if ($currentTag)
                        <div
                            class="flex items-center px-6 py-4 mb-6 bg-white shadow-sm dark:bg-gray-800 rounded-xl dark:shadow-gray-700/50">
                            <span class="text-gray-700 dark:text-gray-300">
                                {{ __('component.news.filtered_by_tag') }}
                            </span>
                            <span
                                class="px-3 py-1 ml-3 text-sm font-medium text-indigo-600 rounded-full dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/50">
                                #{{ $currentTag->name }}
                            </span>
                            <button wire:click.prevent="clearFilter('tag')"
                                class="ml-auto text-sm text-indigo-600 transition-colors dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                <i class="mr-1 fas fa-times"></i> {{ __('component.news.clear_filter') }}
                            </button>
                        </div>
                    @endif

                    <!-- News Grid -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        @forelse($posts as $post)
                            <article
                                class="overflow-hidden transition-all bg-white shadow-sm dark:bg-gray-800 rounded-xl hover:shadow-md dark:hover:shadow-gray-700/50">
                                <!-- Featured Image -->
                                <a href="{{ route('news.show', $post->slug) }}" class="block overflow-hidden">
                                    <img src="{{ $post->featured_image_url }}"
                                        alt="{{ $post->featured_image_caption ?? $post->title }}"
                                        class="object-cover w-full h-48 transition-transform duration-500 hover:scale-105">
                                </a>

                                <!-- Content -->
                                <div class="p-6">
                                    <!-- Tags -->
                                    @if ($post->tags->count() > 0)
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            @foreach ($post->tags->take(3) as $tag)
                                                <a href="{{ route('news.index', ['tag' => $tag->slug]) }}"
                                                    class="px-3 py-1 text-xs font-medium text-indigo-600 transition-colors rounded-full dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/50 hover:bg-indigo-100 dark:hover:bg-indigo-900/70">
                                                    #{{ $tag->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Title -->
                                    <h2 class="mb-3 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                                        <a href="{{ route('news.show', $post->slug) }}"
                                            class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">
                                            {{ $post->title }}
                                        </a>
                                    </h2>

                                    <!-- Meta -->
                                    <div
                                        class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-500 dark:text-gray-400">
                                        <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                                            {{ $post->published_at->format('F j, Y') }}
                                        </time>
                                        <div class="w-px h-4 bg-gray-300 dark:bg-gray-600"></div>
                                        <span>{{ $post->read_time }}</span>
                                    </div>

                                    <!-- Summary -->
                                    <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">
                                        {{ $post->summary }}
                                    </p>

                                    <!-- Read More -->
                                    <a href="{{ route('news.show', $post->slug) }}"
                                        class="inline-flex items-center font-medium text-indigo-600 transition-colors dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                        {{ __('component.news.read_more') }}
                                        <i class="ml-2 text-xs fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-2 py-12 text-center">
                                <i class="text-5xl text-gray-400 dark:text-gray-500 fas fa-newspaper"></i>
                                <h3 class="mt-4 text-xl font-medium text-gray-900 dark:text-white">
                                    {{ __('component.news.no_articles') }}
                                </h3>
                                <p class="mt-2 text-gray-500 dark:text-gray-400">
                                    {{ __('component.news.no_articles_suggestion') }}
                                </p>
                                <a href="{{ route('news.index') }}"
                                    class="inline-block px-4 py-2 mt-4 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-md hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                                    {{ __('component.news.view_all_news') }}
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($posts->hasPages())
                        <div class="mt-10">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                <!-- Sidebar (25% width on large screens) -->
                <div class="lg:w-1/4">
                    <!-- Featured News -->
                    @if ($featuredPosts->isNotEmpty())
                        <div class="p-6 mb-6 bg-white shadow-sm dark:bg-gray-800 rounded-xl dark:shadow-gray-700/50">
                            <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                                {{ __('component.news.featured_news') }}
                            </h3>
                            <div class="space-y-4">
                                @foreach ($featuredPosts as $post)
                                    <div class="flex gap-3">
                                        @if ($post->featured_image)
                                            <a href="{{ route('news.show', $post->slug) }}" class="flex-shrink-0">
                                                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}"
                                                    class="object-cover w-16 h-16 rounded-lg">
                                            </a>
                                        @endif
                                        <div>
                                            <a href="{{ route('news.show', $post->slug) }}"
                                                class="font-medium text-gray-900 transition-colors dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">
                                                {{ Str::limit($post->title, 50) }}
                                            </a>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                {{ $post->published_at->format('M j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Popular Tags -->
                    @if ($topTags->isNotEmpty())
                        <div class="p-6 mb-6 bg-white shadow-sm dark:bg-gray-800 rounded-xl dark:shadow-gray-700/50">
                            <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                                {{ __('component.news.popular_tags') }}
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($topTags as $tag)
                                    <a href="{{ route('news.index', ['tag' => $tag->slug]) }}"
                                        class="px-3 py-1 text-sm font-medium text-indigo-600 transition-colors rounded-full dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/50 hover:bg-indigo-100 dark:hover:bg-indigo-900/70">
                                        #{{ $tag->name }} ({{ $tag->posts_count }})
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Topics -->
                    @if ($topTopics->isNotEmpty())
                        <div class="p-6 bg-white shadow-sm dark:bg-gray-800 rounded-xl dark:shadow-gray-700/50">
                            <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                                {{ __('component.news.topics') }}
                            </h3>
                            <ul class="space-y-3">
                                @foreach ($topTopics as $topic)
                                    <li>
                                        <a href="{{ route('news.index', ['topic' => $topic->slug]) }}"
                                            class="flex items-center justify-between p-2 -mx-2 transition-colors rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <span class="text-gray-700 dark:text-gray-300">{{ $topic->name }}</span>
                                            <span
                                                class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full dark:text-gray-300 dark:bg-gray-700">
                                                {{ $topic->posts_count }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
