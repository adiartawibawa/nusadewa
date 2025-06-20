@extends('layouts.app')

@section('title', $post->title . ' | Nusa Dewa Aquaculture')

@section('content')
    <section class="py-12 bg-white">
        <div class="container px-4 mx-auto">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumbs -->
                <nav class="flex mb-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                                <i class="mr-2 fas fa-home"></i> Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="text-gray-400 fas fa-chevron-right"></i>
                                <a href="{{ route('news.index') }}"
                                    class="ml-1 text-sm font-medium text-gray-700 hover:text-primary md:ml-2">News</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="text-gray-400 fas fa-chevron-right"></i>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $post->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- Article Header -->
                <article>
                    <header class="mb-8">
                        <!-- Tags -->
                        @if ($post->tags->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($post->tags as $tag)
                                    <a href="{{ route('news.index', ['tag' => $tag->slug]) }}"
                                        class="px-3 py-1 text-sm font-medium text-blue-600 transition-colors bg-blue-100 rounded-full hover:bg-blue-200">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <!-- Title -->
                        <h1 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">{{ $post->title }}</h1>

                        <!-- Meta -->
                        <div class="flex flex-col items-start justify-between mt-6 md:flex-row md:items-center">
                            <div class="flex items-center">
                                <div class="mr-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                                        <time
                                            datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('F j, Y') }}</time>
                                        <span aria-hidden="true">&middot;</span>
                                        <span>{{ $post->read_time }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Sharing -->
                            <div class="flex items-center mt-4 space-x-4 md:mt-0">
                                <span class="text-sm font-medium text-gray-500">Share:</span>
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </header>

                    <!-- Featured Image -->
                    @if ($post->featured_image)
                        <figure class="mb-8">
                            <img class="w-full rounded-xl" src="{{ Storage::url($post->featured_image) }}"
                                alt="{{ $post->featured_image_caption }}">
                            @if ($post->featured_image_caption)
                                <figcaption class="mt-2 text-sm text-center text-gray-500">
                                    {{ $post->featured_image_caption }}</figcaption>
                            @endif
                        </figure>
                    @endif

                    <!-- Article Content -->
                    <div class="prose max-w-none">
                        {!! $post->body !!}
                    </div>

                    <!-- Related Product Categories -->
                    @if ($post->productCategories->count() > 0)
                        <div class="mt-12">
                            <h3 class="mb-4 text-xl font-bold text-gray-800">Related Products</h3>
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($post->productCategories as $category)
                                    <a href="{{ route('products.category', $category->slug) }}"
                                        class="flex items-center p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                        @if ($category->image)
                                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                                class="flex-shrink-0 w-16 h-16 rounded-full">
                                        @endif
                                        <div class="ml-4">
                                            <h4 class="font-medium text-gray-900">{{ $category->name }}</h4>
                                            <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ $category->description }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Related Topics -->
                    @if ($post->topics->count() > 0)
                        <div class="mt-12">
                            <h3 class="mb-4 text-xl font-bold text-gray-800">Related Topics</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($post->topics as $topic)
                                    <a href="{{ route('news.index', ['topic' => $topic->slug]) }}"
                                        class="px-4 py-2 text-sm font-medium transition-colors bg-gray-100 rounded-full text-primary hover:bg-gray-200">
                                        {{ $topic->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Translation Links -->
                    {{-- @if ($post->translations->count() > 0)
                        <div class="mt-12">
                            <p class="text-gray-600">This article is also available in:</p>
                            <div class="flex flex-wrap gap-2 mt-2">
                                @foreach ($post->translations as $translation)
                                    <a href="{{ route('news.show', $translation->slug) }}"
                                        class="px-4 py-2 text-sm font-medium transition-colors bg-gray-100 rounded-full text-primary hover:bg-gray-200">
                                        {{ strtoupper($translation->language) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif --}}
                </article>
            </div>
        </div>
    </section>

    <!-- Related News -->
    @if ($relatedNews->count() > 0)
        <section class="py-12 bg-gray-50">
            <div class="container px-4 mx-auto">
                <h2 class="mb-8 text-2xl font-bold text-center text-gray-800 md:text-3xl">You Might Also Like</h2>
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedNews as $related)
                        <div
                            class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:cursor-pointer">
                            @if ($related->featured_image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ Storage::url($related->featured_image) }}"
                                        alt="{{ $related->featured_image_caption }}" class="object-cover w-full h-full">
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach ($related->tags as $tag)
                                        <a href="{{ route('news.index', ['tag' => $tag->slug]) }}"
                                            class="px-2 py-1 text-xs font-medium text-blue-600 transition-colors bg-blue-100 rounded-full hover:bg-blue-200">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <h3 class="mb-3 text-xl font-bold text-gray-800">{{ $related->title }}</h3>
                                <p class="mb-4 text-gray-600 line-clamp-2">{{ $related->summary }}</p>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-sm text-gray-500">{{ $related->published_at->format('M d, Y') }}</span>
                                    <a href="{{ route('news.show', $related->slug) }}"
                                        class="text-sm font-medium text-primary hover:text-secondary">
                                        Read More <i class="ml-1 fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
