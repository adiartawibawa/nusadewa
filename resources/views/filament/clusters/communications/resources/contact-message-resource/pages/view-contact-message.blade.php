<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Original Message --}}
        <x-filament::section>
            <x-slot name="heading">
                Original Message
            </x-slot>

            <div class="grid gap-2 text-sm">
                <div>
                    <span class="font-semibold">Sender:</span>
                    {{ $record->name }} &lt;{{ $record->email }}&gt;
                </div>
                <div>
                    <span class="font-semibold">Date:</span>
                    {{ $record->created_at->format('M d, Y H:i') }}
                </div>
                <div>
                    <span class="font-semibold">Subject:</span>
                    {{ $record->subject }}
                </div>
                <div class="mt-2 text-gray-800 whitespace-pre-wrap dark:text-gray-200">
                    <span class="font-semibold">Message:</span><br>
                    {{ $record->message }}
                </div>
            </div>
        </x-filament::section>

        {{-- Replies --}}
        @foreach ($record->replies()->orderBy('created_at')->get() as $reply)
            <x-filament::section
                class="border-l-4 border-primary-600 dark:border-primary-500 bg-primary-50 dark:bg-gray-800/40">
                <x-slot name="heading">
                    Admin Reply
                </x-slot>

                <div class="grid gap-2 text-sm">
                    <div class="font-medium text-primary-800 dark:text-primary-300">
                        Admin
                    </div>
                    <div class="text-gray-500 dark:text-gray-400">
                        {{ $reply->created_at->format('M d, Y H:i') }}
                    </div>
                    <div class="mt-2 text-gray-800 whitespace-pre-wrap dark:text-gray-200">
                        {{ $reply->message }}
                    </div>
                </div>
            </x-filament::section>
        @endforeach

    </div>
</x-filament-panels::page>
