<div class="py-8 ">
    <!-- Category Filter -->
    <div class="mb-12">
        <div class="flex flex-wrap items-center justify-center gap-3">
            <button wire:click="resetFilters"
                class="px-5 py-2 text-sm font-medium transition-all duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-900
                    {{ !$selectedCategory ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30' : 'bg-gray-700/80 dark:bg-gray-700 text-gray-300 hover:bg-gray-600/80 dark:hover:bg-gray-600' }}">
                All Products
            </button>

            @foreach ($categories as $category)
                <div x-data="{ open: false }" class="relative">
                    <button wire:click="filterByCategory('{{ $category->slug }}')" @click="open = !open"
                        class="flex items-center px-5 py-2 text-sm font-medium transition-all duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-gray-900
                                {{ $selectedCategory === $category->slug ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30' : 'bg-gray-700/80 dark:bg-gray-700 text-gray-300 hover:bg-gray-600/80 dark:hover:bg-gray-600' }}"
                        aria-expanded="false" :aria-expanded="open.toString()" aria-haspopup="true"
                        aria-controls="submenu-{{ $category->slug }}">
                        {{ $category->name }}
                        @if ($category->children->count() > 0)
                            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        @endif
                    </button>

                    @if ($category->children->count() > 0)
                        <div x-show="open" x-transition @click.outside="open = false"
                            class="absolute left-0 z-20 mt-2 space-y-1 bg-gray-800 dark:bg-gray-700 rounded-lg shadow-xl min-w-[200px] border border-gray-700 dark:border-gray-600"
                            id="submenu-{{ $category->slug }}" role="menu">
                            @foreach ($category->children as $child)
                                <button wire:click="filterByCategory('{{ $child->slug }}')"
                                    class="flex items-center justify-between w-full px-4 py-2 text-sm text-left text-gray-300 transition-colors hover:bg-gray-700/80 dark:hover:bg-gray-600 focus:outline-none focus:bg-gray-700/80"
                                    role="menuitem">
                                    <span>{{ $child->name }}</span>
                                    <span
                                        class="text-xs text-gray-400 dark:text-gray-500">({{ $child->posts_count }})</span>
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
            <h3 class="mb-8 text-2xl font-bold text-center text-gray-900 dark:text-white md:text-3xl">Featured Products
            </h3>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredProducts as $product)
                    @include('components.product-card', [
                        'product' => $product,
                        'featured' => true,
                        'class' =>
                            'border-2 border-blue-500 dark:border-blue-600 shadow-lg shadow-blue-500/20 dark:shadow-blue-600/20',
                    ])
                @endforeach
            </div>
        </div>
    @endif

    <!-- All Products -->
    <div>
        <h3 class="mb-8 text-2xl font-bold text-center text-gray-50 dark:text-white md:text-3xl">Product Catalog</h3>

        @if ($products->isNotEmpty())
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @else
            <div
                class="p-8 text-center bg-gray-100 border border-gray-200 dark:bg-gray-800/50 rounded-xl dark:border-gray-700">
                <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="mt-4 text-gray-600 dark:text-gray-400">No products found matching your criteria</p>
                @if ($selectedCategory)
                    <button wire:click="resetFilters"
                        class="mt-4 text-blue-600 transition-colors rounded dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Reset Filters
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
