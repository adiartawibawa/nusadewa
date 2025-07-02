<div
    class="h-full p-6 sm:p-8 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm rounded-xl transition-colors duration-300">
    <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Send Us a Message</h3>
    <p class="mb-6 text-base text-gray-600 dark:text-gray-300">
        Have questions about our shrimp genetics or need technical support?
        Complete the form below and our aquaculture specialists will respond within 24 business hours.
    </p>

    <form wire:submit.prevent="submit" class="space-y-6">
        <!-- Error Messages -->
        <div class="space-y-4">
            @error('rate_limit')
                <div
                    class="p-4 text-sm text-red-700 bg-red-100 dark:bg-red-900/30 dark:text-red-300 rounded-lg flex items-start">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror

            @error('submit_error')
                <div
                    class="p-4 text-sm text-red-700 bg-red-100 dark:bg-red-900/30 dark:text-red-300 rounded-lg flex items-start">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <!-- Name Field -->
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" wire:model="name"
                    class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="John Doe" wire:loading.attr="disabled" aria-describedby="name-error">
                @error('name')
                    <p id="name-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" wire:model="email"
                    class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    placeholder="john@example.com" wire:loading.attr="disabled" aria-describedby="email-error">
                @error('email')
                    <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Subject Field -->
        <div>
            <label for="subject" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Subject <span class="text-red-500">*</span>
            </label>
            <input type="text" id="subject" wire:model="subject"
                class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                placeholder="Inquiry about shrimp genetics" wire:loading.attr="disabled"
                aria-describedby="subject-error">
            @error('subject')
                <p id="subject-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Message Field -->
        <div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Message <span class="text-red-500">*</span>
            </label>
            <textarea id="message" rows="5" wire:model="message"
                class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                placeholder="Please provide details about your inquiry..." wire:loading.attr="disabled"
                aria-describedby="message-error"></textarea>
            @error('message')
                <p id="message-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Success Message -->
        @if ($success)
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="p-4 text-sm text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-start">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                Thank you for your message! Our aquaculture specialists will contact you soon.
            </div>
        @endif

        <!-- Submit Button -->
        <button type="submit" wire:loading.attr="disabled"
            class="w-full px-6 py-3 text-sm font-semibold text-white transition-colors duration-200 bg-blue-600 dark:bg-blue-700 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-70 flex justify-center items-center min-h-[44px]">
            <span wire:loading.remove>Send Message</span>
            <span wire:loading>
                <svg class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span class="sr-only">Sending message...</span>
            </span>
        </button>
    </form>
</div>
