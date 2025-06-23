@props(['product', 'featured' => false])

<div @class([
    'group relative overflow-hidden rounded-xl border transition-all duration-300',
    'h-full border-gray-700 bg-gray-800 hover:border-blue-500/50 hover:shadow-lg hover:shadow-blue-500/10' => !$featured,
    'border-blue-500/30 bg-gradient-to-br from-gray-800 to-gray-900/80 hover:shadow-xl hover:shadow-blue-500/20' => $featured,
])>
    <!-- Badge for featured products -->
    @if ($featured)
        <div class="absolute top-4 right-4 z-10">
            <span
                class="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-blue-500/90">
                Featured
            </span>
        </div>
    @endif

    <!-- Product Image -->
    <div class="relative h-60 overflow-hidden">
        @if ($product->featured_image)
            <img src="{{ $product->featured_image_url }}" alt="{{ $product->title }}"
                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="flex items-center justify-center w-full h-full bg-gray-700/50">
                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        @endif
    </div>

    <!-- Product Content -->
    <div class="p-5">
        <!-- Categories -->
        <div class="flex flex-wrap gap-2 mb-3">
            @foreach ($product->productCategories as $category)
                <span wire:click="filterByCategory('{{ $category->slug }}')"
                    class="px-2.5 py-1 text-xs font-medium transition-colors rounded-full cursor-pointer bg-gray-700/60 text-blue-300 hover:bg-gray-700">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>

        <!-- Title -->
        <h3 class="mb-2 text-lg font-semibold text-white">{{ $product->title }}</h3>

        <!-- Summary -->
        @if ($product->summary)
            <p class="mb-4 text-sm text-gray-300 line-clamp-2">{{ $product->summary }}</p>
        @endif

        <!-- View Button -->
        <a href="{{ route('products.show', $product->slug) }}"
            class="inline-flex items-center text-sm font-medium transition-colors text-blue-400 hover:text-blue-300">
            View Details
            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
        </a>
    </div>
</div>
