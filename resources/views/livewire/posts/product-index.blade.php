<div class="bg-white dark:bg-gray-900">
    <div class="relative items-center bg-gray-900 dark:bg-gray-800">
        <x-layouts.top-header />
        <x-layouts.main-nav />
    </div>

    <div class="bg-gray-50 dark:bg-gray-900">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[['name' => 'Innovations', 'url' => route('innovations.index')]]" />

        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Header and Filters -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Our Products</h1>
                <p class="mt-2 text-lg leading-8 text-gray-600 dark:text-gray-300">Browse our collection of high-quality
                    products</p>

                <!-- Search and Filter Bar -->
                <div class="mt-6 sm:flex sm:items-center sm:justify-between">
                    <!-- Search Input -->
                    <div class="w-full sm:max-w-xs">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.debounce.300ms="search" id="search" name="search" type="search"
                                class="block w-full rounded-md border-0 bg-white dark:bg-gray-800 py-1.5 pl-10 pr-3 text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                placeholder="Search products...">
                        </div>
                    </div>

                    <!-- Category Filter Dropdown -->
                    <div class="mt-4 sm:mt-0 sm:ml-4">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" type="button"
                                class="inline-flex justify-center gap-x-1.5 rounded-md bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
                                id="menu-button" aria-expanded="true" aria-haspopup="true">
                                Categories
                                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1 max-h-60 overflow-auto" role="none">
                                    @foreach ($categories as $category)
                                        <div class="relative flex items-start px-4 py-2">
                                            <div class="flex h-6 items-center">
                                                <input wire:model="selectedCategories" id="category-{{ $category->id }}"
                                                    name="categories[]" value="{{ $category->id }}" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-600 dark:focus:ring-indigo-500 dark:bg-gray-700">
                                            </div>
                                            <div class="ml-3">
                                                <label for="category-{{ $category->id }}"
                                                    class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $category->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Filters -->
                @if (count($selectedCategories) > 0 || $search)
                    <div class="mt-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Filters:</span>
                            @if ($search)
                                <span
                                    class="inline-flex items-center rounded-full bg-indigo-100 dark:bg-indigo-900 px-2.5 py-0.5 text-xs font-medium text-indigo-800 dark:text-indigo-100">
                                    Search: {{ $search }}
                                    <button wire:click="$set('search', '')" type="button"
                                        class="ml-1.5 inline-flex text-indigo-400 hover:text-indigo-500">
                                        <span class="sr-only">Remove filter</span>
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path
                                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                            @foreach ($selectedCategories as $categoryId)
                                @php $category = $categories->firstWhere('id', $categoryId); @endphp
                                @if ($category)
                                    <span
                                        class="inline-flex items-center rounded-full bg-gray-100 dark:bg-gray-800 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:text-gray-300">
                                        {{ $category->name }}
                                        <button wire:click="removeCategoryFilter({{ $categoryId }})" type="button"
                                            class="ml-1.5 inline-flex text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Remove filter</span>
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path
                                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            @endforeach
                            <button wire:click="resetFilters" type="button"
                                class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                                Clear all
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sorting Controls -->
            <div class="mb-6 flex items-center justify-between">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                    results
                </div>
                <div class="flex items-center">
                    <label for="sort" class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300">Sort
                        by:</label>
                    <select wire:model="sortField" id="sort"
                        class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 py-1 pl-2 pr-8 text-base text-gray-900 dark:text-white focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <option value="published_at">Newest</option>
                        <option value="title">Name (A-Z)</option>
                        <option value="views_count">Most Popular</option>
                    </select>
                    <button wire:click="$toggle('sortDirection')"
                        class="ml-2 rounded-md bg-gray-200 dark:bg-gray-700 p-1 text-gray-500 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600"
                        title="{{ $sortDirection === 'asc' ? 'Sort ascending' : 'Sort descending' }}">
                        @if ($sortDirection === 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </button>
                </div>
            </div>

            <!-- Product Grid -->
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    @foreach ($products as $product)
                        <div class="group relative">
                            <div
                                class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-800 xl:aspect-h-8 xl:aspect-w-7">
                                <img src="{{ $product->featured_image_url }}" alt="{{ $product->title }}"
                                    class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300"
                                    loading="lazy">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                        <a href="{{ route('products.show', $product) }}">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $product->title }}
                                        </a>
                                    </h3>
                                    @if ($product->productCategories->count())
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $product->productCategories->first()->name }}
                                        </p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $product->read_time }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $product->views_count }}
                                        views
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filter to
                        find
                        what you're looking for.</p>
                    <div class="mt-6">
                        <button wire:click="resetFilters" type="button"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Reset filters
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
