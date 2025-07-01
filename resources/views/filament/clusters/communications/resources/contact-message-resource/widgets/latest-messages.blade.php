<div class="space-y-4">
    @foreach ($messages as $message)
        <a href="{{ route('filament.admin.communications.resources.contact-messages.view', $message['id']) }}"
            {{-- <a href="#" --}}
            class="block p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors {{ $message['is_read'] ? 'bg-white dark:bg-gray-700' : 'bg-gray-50 dark:bg-gray-800 border border-primary-200 dark:border-primary-800' }}">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-gray-100">
                        {{ $message['name'] }}
                        @if (!$message['is_read'])
                            <span
                                class="ml-2 px-1.5 py-0.5 text-xs rounded-full bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200">New</span>
                        @endif
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $message['email'] }}</p>
                </div>
                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $message['time'] }}</span>
            </div>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 line-clamp-1">{{ $message['subject'] }}</p>
        </a>
    @endforeach

    <div class="mt-2 text-right">
        <a href="{{ route('filament.admin.communications.resources.contact-messages.view', $message['id']) }}"
            {{-- <a href="#" --}}
            class="text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300">
            View all messages
        </a>
    </div>
</div>
