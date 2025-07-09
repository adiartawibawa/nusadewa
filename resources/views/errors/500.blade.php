@extends('layouts.base')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="container min-h-screen px-6 py-12 mx-auto lg:flex lg:items-center lg:gap-12">
            <div class="wf-ull lg:w-1/2">
                <p class="text-sm font-medium text-red-500 dark:text-red-400">
                    {{ __('errors.500.code') }}
                </p>
                <h1 class="mt-3 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">
                    {{ __('errors.500.title') }}
                </h1>
                <p class="mt-4 text-gray-500 dark:text-gray-400">
                    {{ __('errors.500.description') }}
                </p>

                @if (app()->environment('local') && isset($exception) && $exception->getMessage())
                    <div class="mt-4 p-4 bg-red-50 dark:bg-gray-800 rounded-lg">
                        <p class="text-sm text-red-600 dark:text-red-400 font-medium">Debug Message:</p>
                        <p class="text-sm text-red-500 dark:text-red-300 mt-1">{{ $exception->getMessage() }}</p>
                    </div>
                @endif

                <div class="flex items-center mt-6 gap-x-3">
                    <button onclick="window.location.reload()"
                        class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span>{{ __('errors.reload') }}</span>
                    </button>

                    <a href="{{ url('/') }}"
                        class="w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-red-500 rounded-lg shrink-0 sm:w-auto hover:bg-red-600 dark:hover:bg-red-500 dark:bg-red-600">
                        {{ __('errors.home') }}
                    </a>
                </div>
            </div>

            <div class="relative w-full mt-12 lg:w-1/2 lg:mt-0">
                <img class="w-full max-w-lg lg:mx-auto" src="{{ asset('images/500-illustration.png') }}"
                    alt="500 Illustration">
            </div>
        </div>
    </section>
@endsection
