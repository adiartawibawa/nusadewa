<x-filament-panels::page>
    {{-- Form Section --}}
    <x-filament-panels::form :wire:key="'system-settings-form'" wire:submit="save">
        {{ $this->form }}
    </x-filament-panels::form>
</x-filament-panels::page>
