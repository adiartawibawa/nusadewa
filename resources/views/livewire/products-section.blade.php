<div>
    <!-- Category Filter -->
    <div class="mb-12">
        <div class="flex flex-wrap items-center justify-center gap-3">
            <button wire:click="resetFilters"
                class="px-5 py-2 text-sm font-medium transition-all duration-300 rounded-full {{ !$selectedCategory ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'bg-gray-700/80 text-gray-300 hover:bg-gray-600/80' }}">
                All Products
            </button>

            @foreach ($categories as $category)
                <div x-data="{ open: false }" class="relative">
                    <button wire:click="filterByCategory('{{ $category->slug }}')" @click="open = !open"
                        class="flex items-center px-5 py-2 text-sm font-medium transition-all duration-300 rounded-full {{ $selectedCategory === $category->slug ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'bg-gray-700/80 text-gray-300 hover:bg-gray-600/80' }}">
                        {{ $category->name }}
                        @if ($category->children->count() > 0)
                            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        @endif
                    </button>

                    @if ($category->children->count() > 0)
                        <div x-show="open" x-transition @click.outside="open = false"
                            class="absolute left-0 z-20 mt-2 space-y-1 bg-gray-800 rounded-lg shadow-xl min-w-[200px] border border-gray-700">
                            @foreach ($category->children as $child)
                                <button wire:click="filterByCategory('{{ $child->slug }}')"
                                    class="flex items-center justify-between w-full px-4 py-2 text-sm text-left transition-colors hover:bg-gray-700/80">
                                    <span>{{ $child->name }}</span>
                                    <span class="text-xs text-gray-400">({{ $child->posts_count }})</span>
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
            <h3 class="mb-8 text-2xl font-bold text-center text-white md:text-3xl">Featured Products</h3>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredProducts as $product)
                    @include('components.product-card', ['product' => $product, 'featured' => true])
                @endforeach
            </div>
        </div>
    @endif

    <!-- All Products -->
    <div>
        <h3 class="mb-8 text-2xl font-bold text-center text-white md:text-3xl">Product Catalog</h3>

        @if ($products->isNotEmpty())
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-12">
                {{ $products->links('vendor.pagination.custom') }}
            </div>
        @else
            <div class="p-8 text-center bg-gray-800/50 rounded-xl">
                <svg class="w-12 h-12 mx-auto text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="mt-4 text-gray-400">No products found matching your criteria</p>
                @if ($selectedCategory)
                    <button wire:click="resetFilters" class="mt-4 text-blue-400 hover:text-blue-300">
                        Reset Filters
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
