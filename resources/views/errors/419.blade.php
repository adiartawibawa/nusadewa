@extends('layouts.base')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="container min-h-screen px-6 py-12 mx-auto lg:flex lg:items-center lg:gap-12">
            <div class="wf-ull lg:w-1/2">
                <p class="text-sm font-medium text-blue-500 dark:text-blue-400">
                    {{ __('errors.419.code') }}
                </p>
                <h1 class="mt-3 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">
                    {{ __('errors.419.title') }}
                </h1>
                <p class="mt-4 text-gray-500 dark:text-gray-400">
                    {{ __('errors.419.description') }}
                </p>

                <div class="flex items-center mt-6 gap-x-3">
                    <button onclick="window.history.back()"
                        class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 rtl:rotate-180">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>
                        <span>{{ __('errors.419.back') }}</span>
                    </button>

                    <a href="{{ url('/') }}"
                        class="w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                        {{ __('errors.419.home') }}
                    </a>
                </div>
            </div>

            <div class="relative w-full mt-12 lg:w-1/2 lg:mt-0">
                <img class="w-full max-w-lg lg:mx-auto" src="{{ asset('images/419-illustration.png') }}"
                    alt="404 Illustration">
            </div>
        </div>
    </section>
@endsection
