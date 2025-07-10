<x-nusa-dewa-layout>

    <div class="container py-12">
        <div class="max-w-2xl p-8 mx-auto text-center bg-white rounded-lg shadow-md">
            <h1 class="mb-4 text-2xl font-bold text-gray-800">
                {{ __('component.subscription_confirmation.title') }}
            </h1>
            <p class="mb-6 text-gray-600">
                {{ __('component.subscription_confirmation.message') }}
            </p>
            <a href="{{ url('/') }}"
                class="px-6 py-2 font-medium text-white rounded-lg bg-primary hover:bg-secondary">
                {{ __('component.subscription_confirmation.return_home') }}
            </a>
        </div>
    </div>

</x-nusa-dewa-layout>
