<div class="overflow-hidden">
    <div class="relative items-center bg-gray-900 dark:bg-gray-800">
        <!-- Header Top -->
        <x-layouts.top-header />

        <!-- Main Navigation -->
        <x-layouts.main-nav />
    </div>

    <div class="bg-gray-50 dark:bg-gray-900">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[['name' => __('component.products.page_title'), 'url' => route('products.index')]]" :currentItem="$post->title" />

        <div class="px-6 py-16 mx-auto max-w-7xl lg:px-8">
            <div
                class="grid max-w-2xl grid-cols-1 mx-auto gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:pr-8 lg:pt-4">
                    <div class="lg:max-w-lg">
                        @if ($post->productCategories->count())
                            <h2 class="text-base font-semibold leading-7 text-indigo-600">
                                {{ __('component.product_detail.category_label') }}
                                {{ $post->productCategories->first()->name }}
                            </h2>
                        @endif

                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            {{ $post->title }}
                        </h1>

                        @if ($post->summary)
                            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                                {{ $post->summary }}
                            </p>
                        @endif

                        <div class="mt-6 text-lg leading-8 prose text-gray-600 dark:text-gray-300 dark:prose-invert">
                            {!! $post->body !!}
                        </div>

                        <div class="flex items-center mt-6 text-sm gap-x-4">
                            <time datetime="{{ $post->published_at->format('Y-m-d') }}"
                                class="text-gray-500 dark:text-gray-400">
                                {{ __('component.product_detail.published_on') }}
                                {{ $post->published_at->format('M d, Y') }}
                            </time>
                            <span class="text-gray-500 dark:text-gray-400">•</span>
                            <span class="text-gray-500 dark:text-gray-400">
                                {{ $post->read_time }} {{ __('component.product_detail.read_time') }}
                            </span>
                            <span class="text-gray-500 dark:text-gray-400">•</span>
                            <span class="text-gray-500 dark:text-gray-400">
                                {{ $post->views_count }} {{ __('component.product_detail.views') }}
                            </span>
                        </div>

                        @if ($post->tags->count())
                            <div class="mt-6">
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="text-gray-500 dark:text-gray-400">{{ __('component.product_detail.tags_label') }}</span>
                                    @foreach ($post->tags as $tag)
                                        <span
                                            class="inline-flex items-center rounded-full bg-indigo-100 px-2.5 py-0.5 text-xs font-medium text-indigo-800 dark:bg-indigo-900 dark:text-indigo-100">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center mt-10 gap-x-6">
                        <a href="#contact"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            {{ __('component.product_detail.contact_button') }}
                        </a>
                        <a href="{{ route('products.index') }}"
                            class="text-sm font-semibold leading-6 text-gray-700 dark:text-gray-300">
                            {{ __('component.product_detail.back_to_products') }} <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <img src="{{ $post->featured_image_url }}"
                        alt="{{ $post->featured_image_caption ?? $post->title }}"
                        class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0">
                    @if ($post->featured_image_caption)
                        <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">
                            {{ $post->featured_image_caption }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Related Products Section -->
            @if ($relatedProducts->count())
                <div class="px-6 mx-auto mt-32 max-w-7xl lg:px-8">
                    <div class="max-w-2xl mx-auto lg:mx-0">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            {{ __('component.product_detail.related_products.title') }}
                        </h2>
                        <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                            {{ __('component.product_detail.related_products.description') }}
                        </p>
                    </div>

                    <div
                        class="grid max-w-2xl grid-cols-1 mx-auto mt-16 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                        @foreach ($relatedProducts as $related)
                            <article class="flex flex-col items-start justify-between">
                                <div class="relative w-full">
                                    <img src="{{ $related->featured_image_url }}"
                                        alt="{{ $related->featured_image_caption ?? $related->title }}"
                                        class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                                <div class="max-w-xl">
                                    <div class="flex items-center mt-8 text-xs gap-x-4">
                                        <time datetime="{{ $related->published_at->format('Y-m-d') }}"
                                            class="text-gray-500 dark:text-gray-400">
                                            {{ $related->published_at->format('M d, Y') }}
                                        </time>
                                        @if ($related->productCategories->count())
                                            <a href="#"
                                                class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
                                                {{ $related->productCategories->first()->name }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="relative group">
                                        <h3
                                            class="mt-3 text-lg font-semibold leading-6 text-gray-900 dark:text-white group-hover:text-gray-600 dark:group-hover:text-gray-400">
                                            <a href="{{ route('products.show', $related) }}">
                                                <span class="absolute inset-0"></span>
                                                {{ $related->title }}
                                            </a>
                                        </h3>
                                        @if ($related->summary)
                                            <p
                                                class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3 dark:text-gray-400">
                                                {{ $related->summary }}
                                            </p>
                                        @endif
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
