<div class="container max-w-7xl px-4 py-6 mx-auto">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 md:space-x-3">
            <!-- Home Link (Always shown) -->
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 transition-colors hover:text-indigo-600">
                    <i class="mr-2 text-gray-400 fas fa-home"></i> Home
                </a>
            </li>

            <!-- Dynamic Items -->
            @foreach ($items as $item)
                <li>
                    <div class="flex items-center">
                        <i class="text-xs text-gray-300 fas fa-chevron-right"></i>
                        <a href="{{ $item['url'] }}"
                            class="ml-2 text-sm font-medium text-gray-500 transition-colors hover:text-indigo-600 md:ml-3">
                            {{ $item['name'] }}
                        </a>
                    </div>
                </li>
            @endforeach

            <!-- Current Page -->
            @if ($currentItem)
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="text-xs text-gray-300 fas fa-chevron-right"></i>
                        <span class="max-w-xs ml-2 text-sm font-medium text-gray-400 truncate md:ml-3">
                            {{ $currentItem }}
                        </span>
                    </div>
                </li>
            @endif
        </ol>
    </nav>
</div>

{{-- <x-breadcrumbs :items="[
            ['name' => 'News', 'url' => route('news.index')],
            ...$post->category
                ? [['name' => $post->category->name, 'url' => route('news.category', $post->category)]]
                : [],
        ]" :currentItem="$post->title" /> --}}
