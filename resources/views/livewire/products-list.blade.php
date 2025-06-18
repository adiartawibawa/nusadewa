<div>
    <!-- Filter Controls -->
    <div class="flex flex-col items-center justify-between mb-8 space-y-4 md:flex-row md:space-y-0">
        <div class="flex flex-wrap justify-center gap-2">
            <button wire:click="resetFilters"
                class="px-4 py-2 text-sm font-medium transition-colors rounded-full {{ !$selectedCategory ? 'bg-primary text-white' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                All Products
            </button>

            @foreach ($categories as $category)
                <button wire:click="filterByCategory('{{ $category->slug }}')"
                    class="px-4 py-2 text-sm font-medium transition-colors rounded-full {{ $selectedCategory === $category->slug ? 'bg-primary text-white' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Featured Products -->
    @if ($featuredProducts->count() > 0)
        <div class="mb-16">
            <h3 class="mb-6 text-2xl font-bold text-white">Featured Products</h3>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach ($featuredProducts as $product)
                    <div
                        class="overflow-hidden transition-all duration-300 transform bg-white border border-white bg-opacity-10 backdrop-blur-sm rounded-xl border-opacity-20 hover:border-opacity-40 hover:-translate-y-2">
                        @if ($product->featured_image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $product->featured_image) }}"
                                    alt="{{ $product->featured_image_caption }}" class="object-cover w-full h-full">
                            </div>
                        @else
                            <div class="flex items-center justify-center h-48 bg-gray-800">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($product->productCategories as $category)
                                    <span wire:click="filterByCategory('{{ $category->slug }}')"
                                        class="px-2 py-1 text-xs font-medium transition-colors rounded-full cursor-pointer text-primary bg-white/20 hover:bg-white/30">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                            <h3 class="mb-3 text-xl font-bold text-white">{{ $product->title }}</h3>
                            <p class="text-gray-300 line-clamp-2">{{ $product->summary }}</p>
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="inline-block mt-4 font-medium transition-colors text-primary hover:text-white">
                                Learn More <i class="ml-1 fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Products Grid -->
    @if ($products->count() > 0)
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <div
                    class="overflow-hidden transition-all duration-300 transform bg-white border border-white bg-opacity-10 backdrop-blur-sm rounded-xl border-opacity-20 hover:border-opacity-40 hover:-translate-y-2">
                    @if ($product->featured_image)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->featured_image) }}"
                                alt="{{ $product->featured_image_caption }}" class="object-cover w-full h-full">
                        </div>
                    @else
                        <div class="flex items-center justify-center h-48 bg-gray-800">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach ($product->productCategories as $category)
                                <span wire:click="filterByCategory('{{ $category->slug }}')"
                                    class="px-2 py-1 text-xs font-medium transition-colors rounded-full cursor-pointer text-primary bg-white/20 hover:bg-white/30">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                        <h3 class="mb-3 text-xl font-bold text-white">{{ $product->title }}</h3>
                        <p class="text-gray-300 line-clamp-2">{{ $product->summary }}</p>
                        <a href="{{ route('products.show', $product->slug) }}"
                            class="inline-block mt-4 font-medium transition-colors text-primary hover:text-white">
                            Learn More <i class="ml-1 fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @else
        <div class="p-8 text-center rounded-lg bg-white/10">
            <p class="text-gray-300">No products found.</p>
            @if ($selectedCategory)
                <button wire:click="resetFilters" class="mt-4 text-primary hover:underline">
                    Reset filter
                </button>
            @endif
        </div>
    @endif
</div>
