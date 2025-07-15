<div class="py-12 bg-transparent dark:bg-gray-900">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Category Filter -->
        <div class="mb-12">
            <div class="flex flex-wrap items-center justify-center gap-3">
                <!-- All Products Button -->
                <button wire:click="resetFilters" @class([
                    'px-5 py-2 text-sm font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500',
                    'bg-blue-600 text-white hover:bg-blue-700' => is_null($selectedCategory),
                    'bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600' => !is_null(
                        $selectedCategory),
                ])>
                    {{ __('component.product_catalog.all_products') }}
                </button>

                <!-- Category Buttons -->
                @foreach ($categories as $category)
                    <div x-data="{ open: false }" class="relative">
                        <button wire:click="filterByCategory('{{ $category->slug }}')" @click="open = !open"
                            @class([
                                'flex items-center px-5 py-2 text-sm font-medium transition-all duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500',
                                'bg-blue-600 text-white hover:bg-blue-700' =>
                                    $selectedCategory === $category->slug,
                                'bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600' =>
                                    $selectedCategory !== $category->slug,
                            ])>
                            {{ $category->name }}
                            @if ($category->children->isNotEmpty())
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            @endif
                        </button>

                        @if ($category->children->isNotEmpty())
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute left-0 z-20 mt-2 space-y-1 bg-white dark:bg-gray-800 rounded-lg shadow-lg min-w-[200px] border border-gray-200 dark:border-gray-700">
                                @foreach ($category->children as $child)
                                    <button wire:click="filterByCategory('{{ $child->slug }}')"
                                        class="flex items-center justify-between w-full px-4 py-2 text-sm text-left hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <span class="text-gray-800 dark:text-gray-200">{{ $child->name }}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ str_replace(':count', $child->posts_count, __('component.product_catalog.product_count')) }}
                                        </span>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Featured Products -->
        @if ($featuredProducts->isNotEmpty())
            <div class="mb-16">
                <h2 class="mb-8 text-3xl font-bold text-center text-gray-900 dark:text-white md:text-4xl">
                    {{ __('component.product_catalog.featured_products') }}
                </h2>

                <!-- SKELETON LOADER -->
                {{-- <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-3" wire:loading>
                    @for ($i = 0; $i < 3; $i++)
                        <x-card :skeleton="true" />
                    @endfor
                </div> --}}

                <!-- ACTUAL DATA -->
                <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-3" wire:loading.remove>
                    @foreach ($featuredProducts as $post)
                        <x-card :item="$post" route="products.show" :featured="$post->is_featured" :read-time="$post->read_time"
                            :labels="$post->productCategories" label-action="filterByCategory" :use-tags="false" />
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Product Catalog -->
        <div>
            <h2 class="mb-8 text-3xl font-bold text-center text-gray-900 dark:text-white md:text-4xl">
                {{ __('component.product_catalog.product_catalog') }}
            </h2>

            <!-- SKELETON LOADER -->
            {{-- <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3" wire:loading>
                @for ($i = 0; $i < 6; $i++)
                    <x-card :skeleton="true" />
                @endfor
            </div> --}}

            <!-- ACTUAL DATA -->
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3" wire:loading.remove>
                @foreach ($products as $post)
                    <x-card :item="$post" route="products.show" :featured="$post->is_featured" :read-time="$post->read_time"
                        :labels="$post->productCategories" label-action="filterByCategory" :use-tags="false" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12" wire:loading.remove>
                {{ $products->onEachSide(1)->links() }}
            </div>

            <!-- Empty State -->
            @if ($products->isEmpty())
                <div
                    class="p-8 mt-12 text-center bg-gray-100 border border-gray-200 rounded-xl dark:bg-gray-800 dark:border-gray-700">
                    <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-200">
                        {{ __('component.product_catalog.no_products') }}
                    </h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        @if ($selectedCategory)
                            {{ __('Try adjusting your filters or') }}
                            <button wire:click="resetFilters"
                                class="mt-4 font-medium text-blue-600 transition-colors rounded dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                {{ __('component.product_catalog.reset_filters') }}
                            </button>
                        @else
                            {{ __('component.product_catalog.check_back_later') }}
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
