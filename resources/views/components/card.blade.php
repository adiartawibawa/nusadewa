@props([
    'skeleton' => false,
    'item',
    'route' => null,
    'featured' => false,
    'categories' => [],
    'tags' => [],
    'titleKey' => 'title',
    'summaryKey' => 'summary',
    'imageKey' => 'featured_image_url',
    'slugKey' => 'slug',
    'publishedAtKey' => 'published_at',
    'readTime' => null,
    'viewsCount' => null,
    'tagAction' => null,
    'labels' => [],
    'labelAction' => null,
    'useTags' => true,
])

@php
    if (!$skeleton) {
        $image = data_get($item, $imageKey);
        $title = data_get($item, $titleKey);
        $summary = data_get($item, $summaryKey);
        $slug = data_get($item, $slugKey);
        $publishedAt = data_get($item, $publishedAtKey);
        $link = $route ? route($route, $slug) : '#';
        $tags = $tags ?: (method_exists($item, 'tags') ? $item->tags : []);
    }
@endphp

@if ($skeleton)
    {{-- SKELETON STATE --}}
    <div
        class="relative overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm dark:bg-gray-800 dark:border-gray-700 rounded-xl animate-pulse">

        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700"></div>

        <div class="p-5 space-y-3">
            <div class="w-1/2 h-4 bg-gray-300 rounded dark:bg-gray-600"></div>
            <div class="flex gap-2">
                <div class="w-16 h-6 bg-gray-300 rounded-full dark:bg-gray-600"></div>
                <div class="w-20 h-6 bg-gray-300 rounded-full dark:bg-gray-600"></div>
            </div>
            <div class="w-full h-4 bg-gray-300 rounded dark:bg-gray-600"></div>
            <div class="w-5/6 h-4 bg-gray-300 rounded dark:bg-gray-600"></div>
            <div class="flex justify-between pt-4 text-xs text-gray-400">
                <div class="w-24 h-3 bg-gray-300 rounded dark:bg-gray-600"></div>
                <div class="w-16 h-3 bg-gray-300 rounded dark:bg-gray-600"></div>
            </div>
        </div>
    </div>
@else
    {{-- NORMAL CARD --}}
    <div
        class="relative overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm dark:bg-gray-800 dark:border-gray-700 rounded-xl hover:shadow-md hover:border-blue-100 dark:hover:border-blue-900/50">
        @if ($featured)
            <div class="absolute z-10 top-4 right-4">
                <span
                    class="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase rounded-full shadow-md bg-gradient-to-r from-blue-500 to-blue-600">
                    Featured
                </span>
            </div>
        @endif

        @if ($image)
            <img src="{{ $image }}" alt="{{ $title }}" class="object-cover w-full h-48" loading="lazy">
        @else
            <div class="flex items-center justify-center h-48 text-gray-400 bg-gray-50 dark:bg-gray-700">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif

        <div class="p-5">
            @if ($useTags && count($tags))
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach ($tags as $tag)
                        @if ($tagAction)
                            <button wire:click="{{ $tagAction }}('{{ $tag->slug }}')"
                                class="px-2 py-1 text-xs font-medium text-blue-600 transition-all duration-200 rounded-full dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30">
                                {{ $tag->name }}
                            </button>
                        @else
                            <span
                                class="px-2 py-1 text-xs font-medium text-blue-600 rounded-full dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20">
                                {{ $tag->name }}
                            </span>
                        @endif
                    @endforeach
                </div>
            @endif

            @if (count($labels))
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach ($labels as $label)
                        @if ($labelAction)
                            <button wire:click="{{ $labelAction }}('{{ $label->slug }}')"
                                class="px-2 py-1 text-xs font-medium text-blue-600 transition-all duration-200 rounded-full dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30">
                                {{ $label->name }}
                            </button>
                        @else
                            <span
                                class="px-2 py-1 text-xs font-medium text-blue-600 rounded-full dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20">
                                {{ $label->name }}
                            </span>
                        @endif
                    @endforeach
                </div>
            @endif

            <h3
                class="mb-2 text-xl font-bold text-gray-800 transition-colors dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                <a href="{{ $link }}" class="rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {!! $title !!}
                </a>
            </h3>

            @if ($summary)
                <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">{!! $summary !!}</p>
            @endif

            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span>
                    @if ($publishedAt)
                        {{ \Carbon\Carbon::parse($publishedAt)->format('M d, Y') }}
                    @endif
                    @if ($readTime)
                        • {{ $readTime }}
                    @endif
                </span>
                <a href="{{ $link }}"
                    class="font-medium text-blue-600 transition-colors rounded dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ __('component.news_section.read_more') }}
                </a>
            </div>
        </div>
    </div>
@endif
