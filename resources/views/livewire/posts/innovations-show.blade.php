<div class="dark:bg-gray-900">
    <div class="relative items-center bg-gray-900 dark:bg-gray-800">
        <!-- Header Top -->
        <x-layouts.top-header />

        <!-- Main Navigation -->
        <x-layouts.main-nav />
    </div>

    <div class="bg-gray-50 dark:bg-gray-900">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[['name' => 'Innovations', 'url' => route('innovations.index')]]" :currentItem="$innovation->title" />

        <!-- Main Content -->
        <div class="container px-4 mx-auto max-w-7xl">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 rounded-xl dark:shadow-gray-700/50">
                <!-- Featured Image -->
                <div class="relative w-full h-96 md:h-[32rem] overflow-hidden">
                    <img src="{{ $innovation->featured_image_url }}" alt="{{ $innovation->featured_image_caption }}"
                        class="object-cover w-full h-full" loading="lazy">
                    @if ($innovation->featured_image_caption)
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 text-sm text-white bg-gradient-to-t from-black/80 to-transparent">
                            {{ $innovation->featured_image_caption }}
                        </div>
                    @endif
                </div>

                <div class="relative px-6 py-8 sm:px-10 sm:py-12 md:px-12">
                    <!-- Tags -->
                    @if ($innovation->tags->count() > 0)
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($innovation->tags as $tag)
                                <a href="{{ route('innovations.index', ['tag' => $tag->slug]) }}"
                                    class="px-3 py-1 text-xs font-medium text-indigo-600 transition-colors rounded-full dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/50 hover:bg-indigo-100 dark:hover:bg-indigo-900/70">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <!-- Title -->
                    <h1
                        class="mb-4 text-3xl font-bold leading-tight text-gray-900 dark:text-white md:text-4xl lg:text-5xl">
                        {{ $innovation->title }}
                    </h1>

                    <!-- Meta -->
                    <div class="flex flex-wrap items-center gap-4 mb-8 text-sm text-gray-500 dark:text-gray-400">
                        @if ($innovation->user)
                            <div class="flex items-center">
                                <span class="mr-1">{{ __('component.innovation_detail.by_author') }}</span>
                                <a href="#"
                                    class="font-medium text-indigo-600 transition-colors dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                    {{ $innovation->user->name }}
                                </a>
                            </div>
                            <div class="w-px h-4 bg-gray-300 dark:bg-gray-600"></div>
                        @endif

                        @if ($innovation->published_at)
                            <time datetime="{{ $innovation->published_at->format('Y-m-d') }}">
                                {{ $innovation->published_at->format('F j, Y') }}
                            </time>
                            <div class="w-px h-4 bg-gray-300 dark:bg-gray-600"></div>
                        @endif

                        <span>{{ $innovation->read_time }}</span>

                        <div class="w-px h-4 bg-gray-300 dark:bg-gray-600"></div>

                        <span class="flex items-center">
                            <i class="mr-1 text-gray-400 fas fa-eye"></i>
                            {{ number_format($innovation->views_count) }}
                            {{ __('component.innovation_detail.views') }}
                        </span>
                    </div>

                    <!-- Article Content -->
                    <div
                        class="prose prose-base max-w-none dark:prose-invert prose-indigo prose-headings:font-sans prose-img:rounded-lg prose-img:shadow-md dark:prose-img:shadow-gray-700/50">
                        {!! $innovation->body !!}
                    </div>

                    <!-- Social Sharing -->
                    <div class="pt-8 mt-12 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                            <div class="flex items-center mb-4 sm:mb-0">
                                <span class="mr-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('component.innovation_detail.share_innovation') }}
                                </span>
                                <div class="flex space-x-2">
                                    <a href="#"
                                        class="p-2 text-gray-500 transition-colors bg-gray-100 rounded-full dark:text-gray-400 dark:bg-gray-700 hover:bg-blue-600 hover:text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#"
                                        class="p-2 text-gray-500 transition-colors bg-gray-100 rounded-full dark:text-gray-400 dark:bg-gray-700 hover:bg-blue-400 hover:text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#"
                                        class="p-2 text-gray-500 transition-colors bg-gray-100 rounded-full dark:text-gray-400 dark:bg-gray-700 hover:bg-blue-700 hover:text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('component.innovation_detail.published_on') }}
                                {{ $innovation->published_at->format('F j, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Content Sections -->
        <div class="container px-4 py-12 mx-auto space-y-12 max-w-7xl">
            <!-- Related Product Categories -->
            @if ($innovation->productCategories->count() > 0)
                <div class="space-y-6">
                    <h3 class="font-sans text-2xl font-bold text-gray-900 dark:text-white md:text-3xl">
                        {{ __('component.innovation_detail.related_products') }}
                    </h3>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($innovation->productCategories as $category)
                            <a href="{{ route('products.category', $category->slug) }}"
                                class="flex items-start p-4 transition-all bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 hover:shadow-md dark:hover:shadow-gray-700/50 hover:border-indigo-100 dark:hover:border-indigo-900">
                                @if ($category->image)
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                        class="flex-shrink-0 object-cover w-16 h-16 rounded-lg">
                                @endif
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900 dark:text-white">{{ $category->name }}</h4>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                        {{ $category->description }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Related Topics -->
            @if ($innovation->topics->count() > 0)
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white md:text-3xl">
                        {{ __('component.innovation_detail.explore_topics') }}
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($innovation->topics as $topic)
                            <a href="{{ route('innovations.index', ['topic' => $topic->slug]) }}"
                                class="px-4 py-2 text-sm font-medium text-indigo-600 transition-colors bg-gray-100 rounded-full dark:text-indigo-400 dark:bg-gray-700 hover:bg-indigo-100 dark:hover:bg-indigo-900/70">
                                {{ $topic->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Related Innovations -->
            @if ($relatedInnovations->count() > 0)
                <div class="space-y-6">
                    <h3 class="font-sans text-2xl font-bold text-gray-900 dark:text-white md:text-3xl">
                        {{ __('component.innovation_detail.related_innovations') }}
                    </h3>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($relatedInnovations as $related)
                            <article
                                class="overflow-hidden transition-all bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-xl hover:shadow-lg dark:hover:shadow-gray-700/50">
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ $related->featured_image_url }}"
                                        alt="{{ $related->featured_image_caption }}"
                                        class="object-cover w-full h-full transition-transform duration-500 hover:scale-105"
                                        loading="lazy">
                                </div>
                                <div class="p-6">
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @foreach ($related->tags as $tag)
                                            <a href="{{ route('innovations.index', ['tag' => $tag->slug]) }}"
                                                class="px-2 py-1 text-xs font-medium text-indigo-600 transition-colors rounded-full dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/50 hover:bg-indigo-100 dark:hover:bg-indigo-900/70">
                                                {{ $tag->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <h3 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">
                                        <a href="{{ route('innovations.show', $related->slug) }}"
                                            class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">
                                            {{ $related->title }}
                                        </a>
                                    </h3>
                                    <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">
                                        {{ $related->summary }}</p>
                                    <div class="flex items-center justify-between">
                                        <time
                                            class="text-sm text-gray-500 dark:text-gray-400">{{ $related->published_at->format('M j, Y') }}</time>
                                        <a href="{{ route('innovations.show', $related->slug) }}"
                                            class="text-sm font-medium text-indigo-600 transition-colors dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                            {{ __('component.innovation_detail.read_more') }} <i
                                                class="ml-1 fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
