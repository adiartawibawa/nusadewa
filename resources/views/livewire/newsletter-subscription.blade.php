<div>
    <form wire:submit.prevent="subscribe" class="mb-3">
        <div class="flex">
            <input type="email" wire:model="email"
                placeholder="{{ __('component.subscription_form.email_placeholder') }}"
                class="w-full px-3 py-1.5 text-xs text-gray-800 rounded-l-lg focus:outline-none focus:ring-1 focus:ring-primary"
                required>
            <button type="submit"
                class="px-3 py-1.5 text-xs text-white transition-colors rounded-r-lg bg-primary hover:bg-secondary focus:outline-none focus:ring-1 focus:ring-primary"
                wire:loading.attr="disabled">
                <span wire:loading.remove>{{ __('component.subscription_form.subscribe_button') }}</span>
                <span wire:loading wire:target="subscribe">
                    <i class="fas fa-spinner fa-spin"></i>
                    <span class="sr-only">{{ __('component.subscription_form.loading') }}</span>
                </span>
            </button>
        </div>
        @error('email')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
        @if ($success)
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="mt-1 text-xs text-green-500">
                {{ __('component.subscription_form.success_message') }}
            </p>
        @endif
    </form>
    <p class="text-xs text-gray-400">{{ __('component.subscription_form.description') }}</p>
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
