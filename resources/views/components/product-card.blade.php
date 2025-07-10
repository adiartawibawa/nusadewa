@props(['product', 'featured' => false])

<div @class([
    'group relative overflow-hidden rounded-xl border transition-all duration-300 transform',
    'h-full border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-blue-500/50 hover:shadow-lg hover:shadow-blue-500/10 hover:-translate-y-1' => !$featured,
    'border-blue-400/30 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900/80 hover:shadow-xl hover:shadow-blue-500/20 hover:-translate-y-1.5' => $featured,
])>
    <!-- Badge for featured products -->
    @if ($featured)
        <div class="absolute top-4 right-4 z-10">
            <span
                class="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase rounded-full bg-gradient-to-r from-blue-500 to-blue-600 shadow-md">
                Featured
            </span>
        </div>
    @endif

    <!-- Product Image -->
    <div class="relative h-60 overflow-hidden">
        @if ($product->featured_image)
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/30 via-gray-900/10 to-transparent z-[1]"></div>
            <img src="{{ $product->featured_image_url }}" alt="{{ $product->title }}"
                class="object-cover w-full h-full transition-all duration-500 group-hover:scale-110" loading="lazy">
        @else
            <div class="flex items-center justify-center w-full h-full bg-gray-100 dark:bg-gray-700/50">
                <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
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
        @if ($product->productCategories->count())
            <div class="flex flex-wrap gap-2 mb-3">
                @foreach ($product->productCategories as $category)
                    <span wire:click="filterByCategory('{{ $category->slug }}')" @class([
                        'px-2.5 py-1 text-xs font-medium transition-all duration-200 rounded-full cursor-pointer',
                        'bg-gray-100 text-blue-600 hover:bg-gray-200 dark:bg-gray-700/60 dark:text-blue-300 dark:hover:bg-gray-700' => !$featured,
                        'bg-blue-50 text-blue-700 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50' => $featured,
                    ])>
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Title -->
        <h3
            class="mb-2 text-lg font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
            <a href="{{ route('products.show', $product->slug) }}" class="focus:outline-none">
                <!-- Extended touch target -->
                <span class="absolute inset-0" aria-hidden="true"></span>
                {{ $product->title }}
            </a>
        </h3>

        <!-- Summary -->
        @if ($product->summary)
            <p class="mb-4 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">{{ $product->summary }}</p>
        @endif

        <!-- Metadata -->
        <div class="flex items-center justify-between mt-4 text-sm">
            <span class="text-gray-500 dark:text-gray-400 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ $product->read_time }}
            </span>
            <span class="text-gray-500 dark:text-gray-400 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
                {{ $product->views_count }} views
            </span>
        </div>

        <!-- View Button -->
        <div class="mt-5">
            <a href="{{ route('products.show', $product->slug) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium transition-all duration-200 rounded-lg bg-gray-50 text-blue-600 hover:bg-gray-100 dark:bg-gray-700 dark:text-blue-400 dark:hover:bg-gray-600 group-hover:bg-blue-50 dark:group-hover:bg-blue-900/30 group-hover:text-blue-700 dark:group-hover:text-blue-300">
                View Details
                <svg class="w-4 h-4 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>
