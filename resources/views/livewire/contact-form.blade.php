<div class="h-full p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
    <h3 class="mb-6 text-2xl font-bold text-gray-900">Send Us a Message</h3>
    <p class="mb-6 text-base text-gray-600">
        Have questions about our shrimp genetics or need technical support?
        Complete the form below and our aquaculture specialists will respond within 24 business hours.
    </p>

    <form wire:submit.prevent="submit" class="space-y-6">
        <!-- Error Message -->
        @error('rate_limit')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                {{ $message }}
            </div>
        @enderror

        @error('submit_error')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                {{ $message }}
            </div>
        @enderror

        <div class="grid gap-6 md:grid-cols-2">
            <!-- Name Field -->
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" wire:model="name"
                    class="w-full px-4 py-3 text-gray-700 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="John Doe" wire:loading.attr="disabled">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" wire:model="email"
                    class="w-full px-4 py-3 text-gray-700 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="john@example.com" wire:loading.attr="disabled">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Subject Field -->
        <div>
            <label for="subject" class="block mb-2 text-sm font-medium text-gray-700">
                Subject <span class="text-red-500">*</span>
            </label>
            <input type="text" id="subject" wire:model="subject"
                class="w-full px-4 py-3 text-gray-700 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Inquiry about shrimp genetics" wire:loading.attr="disabled">
            @error('subject')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Message Field -->
        <div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-700">
                Message <span class="text-red-500">*</span>
            </label>
            <textarea id="message" rows="5" wire:model="message"
                class="w-full px-4 py-3 text-gray-700 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Please provide details about your inquiry..." wire:loading.attr="disabled"></textarea>
            @error('message')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Success Message -->
        @if ($success)
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    Thank you for your message! Our aquaculture specialists will contact you soon.
                </div>
            </div>
        @endif

        <!-- Submit Button -->
        <button type="submit" wire:loading.attr="disabled"
            class="w-full px-6 py-3 text-sm font-semibold text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-70">
            <span wire:loading.remove>Send Message</span>
            <span wire:loading>
                <svg class="w-5 h-5 mx-auto animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </span>
        </button>
    </form>
</div>
