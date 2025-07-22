<div class="bg-white dark:bg-gray-900">
    <div class="relative items-center bg-gray-900 dark:bg-gray-800">
        <x-layouts.top-header />
        <x-layouts.main-nav />
    </div>

    <div class="bg-gray-50 dark:bg-gray-900">
        <!-- Page Header -->
        <div class="relative bg-cover bg-center bg-no-repeat min-h-[40vh] sm:min-h-[50vh] lg:min-h-[60vh]"
            style="background-image: url('{{ $appearance['getSectionByName']('Product Header')['image_url'] ?? asset('images/hero.jpg') }}')">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-blue-900/40 dark:bg-blue-950/40"></div>

            <!-- Content Wrapper -->
            <div class="relative z-10 px-4 py-20 mx-auto max-w-7xl sm:py-28 sm:px-6 lg:py-36 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    {{ __('component.products.page_title') }}
                </h1>
                <p class="max-w-3xl mt-4 text-lg text-blue-100 sm:text-xl dark:text-blue-200">
                    {{ __('component.products.page_subtitle') }}
                </p>
            </div>
        </div>

        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[['name' => 'Products', 'url' => route('products.index')]]" />

        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <!-- Header and Filters -->
            <div class="mb-8">
                <!-- Search and Filter Bar -->
                <div class="mt-6 sm:flex sm:items-center sm:justify-between">
                    <!-- Search Input -->
                    <div class="w-full sm:max-w-xs">
                        <label for="search" class="sr-only">{{ __('component.products.search_placeholder') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.debounce.300ms="search" id="search" name="search" type="search"
                                class="block w-full rounded-md border-0 bg-white dark:bg-gray-800 py-1.5 pl-10 pr-3 text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                placeholder="{{ __('component.products.search_placeholder') }}">
                        </div>
                    </div>

                    <!-- Category Filter Dropdown -->
                    <div class="mt-4 sm:mt-0 sm:ml-4">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" type="button"
                                class="inline-flex justify-center gap-x-1.5 rounded-md bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
                                id="menu-button" aria-expanded="true" aria-haspopup="true">
                                {{ __('component.products.categories') }}
                                <svg class="w-5 h-5 -mr-1 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 z-10 w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1 overflow-auto max-h-60" role="none">
                                    @foreach ($categories as $category)
                                        <div class="relative flex items-start px-4 py-2">
                                            <div class="flex items-center h-6">
                                                <input wire:model="selectedCategories" id="category-{{ $category->id }}"
                                                    name="categories[]" value="{{ $category->id }}" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded dark:border-gray-600 focus:ring-blue-600 dark:focus:ring-blue-500 dark:bg-gray-700">
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
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('component.products.filters') }}
                            </span>
                            @if ($search)
                                <span
                                    class="inline-flex items-center rounded-full bg-blue-100 dark:bg-blue-900 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:text-blue-100">
                                    Search: {{ $search }}
                                    <button wire:click="$set('search', '')" type="button"
                                        class="ml-1.5 inline-flex text-blue-400 hover:text-blue-500">
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
                                class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">
                                {{ __('component.products.clear_all') }}
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sorting Controls -->
            <div class="flex items-center justify-between mb-6">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ str_replace([':first', ':last', ':total'], [$products->firstItem(), $products->lastItem(), $products->total()], __('component.products.showing_results')) }}
                </div>
                <div class="flex items-center">
                    <label for="sort" class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('component.products.sort_by') }}
                    </label>
                    <select wire:model="sortField" id="sort"
                        class="py-1 pl-2 pr-8 text-base text-gray-900 border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                        @foreach (__('component.products.sort_options') as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <button wire:click="$toggle('sortDirection')"
                        class="p-1 ml-2 text-gray-500 bg-gray-200 rounded-md dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600"
                        title="{{ $sortDirection === 'asc' ? __('component.products.sort_asc') : __('component.products.sort_desc') }}">
                        @if ($sortDirection === 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
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
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($products as $product)
                        <x-card :item="$product" route="products.show" :categories="$product->productCategories" :tags="$product->tags ?? []"
                            :readTime="$product->read_time" :viewsCount="$product->views_count" titleKey="title" summaryKey="summary"
                            imageKey="featured_image_url" slugKey="slug" publishedAtKey="published_at"
                            :featured="$loop->first" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @else
                <div class="py-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('component.products.no_products') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('component.products.no_products_suggestion') }}
                    </p>
                    <div class="mt-6">
                        <button wire:click="resetFilters" type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            {{ __('component.products.reset_filters') }}
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
