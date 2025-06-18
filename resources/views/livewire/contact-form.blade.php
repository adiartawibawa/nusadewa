<div class="h-full p-8 bg-white shadow-md rounded-xl">
    <h3 class="mb-6 text-2xl font-bold text-gray-800">Send Us a Message</h3>

    <form wire:submit.prevent="submit" class="space-y-6">
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 font-medium text-gray-700">Your Name *</label>
                <input type="text" id="name" wire:model="name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Your full name">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block mb-2 font-medium text-gray-700">Email Address *</label>
                <input type="email" id="email" wire:model="email"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="your.email@example.com">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="subject" class="block mb-2 font-medium text-gray-700">Subject *</label>
            <input type="text" id="subject" wire:model="subject"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                placeholder="What's this about?">
            @error('subject')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block mb-2 font-medium text-gray-700">Message *</label>
            <textarea id="message" rows="5" wire:model="message"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                placeholder="Your message here..."></textarea>
            @error('message')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        @if ($success)
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="p-4 text-green-700 bg-green-100 rounded-lg">
                Thank you for your message! We'll get back to you soon.
            </div>
        @endif

        <button type="submit"
            class="w-full px-6 py-3 font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
            Send Message
        </button>
    </form>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('reset-success', () => {
                setTimeout(() => {
                    @this.set('success', false);
                }, 5000);
            });
        });
    </script>
@endpush
