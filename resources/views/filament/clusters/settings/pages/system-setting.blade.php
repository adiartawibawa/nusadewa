<x-filament-panels::page>
    {{-- Form Section --}}
    <x-filament-panels::form :wire:key="'system-settings-form'" wire:submit="save">
        {{ $this->form }}

        <x-filament-actions::actions :actions="$this->getHeaderActions()" class="mt-6" />

    </x-filament-panels::form>
</x-filament-panels::page>
