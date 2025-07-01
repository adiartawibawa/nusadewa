<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    Latest Contact Messages
                </span>
                <a href="{{ route('filament.admin.communications.resources.contact-messages.index') }}"
                    class="text-sm font-medium text-primary-500 hover:text-primary-600 dark:text-primary-400 dark:hover:text-primary-300 transition-colors">
                    View all messages
                </a>
            </div>
        </x-slot>

        <div class="space-y-3">
            @forelse ($messages as $message)
                <a href="{{ route('filament.admin.communications.resources.contact-messages.view', $message['id']) }}"
                    class="group block p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors duration-150">

                    <div class="flex items-start gap-3">
                        <!-- Avatar -->
                        <div class="flex-shrink-0 mt-1">
                            <div
                                class="h-9 w-9 rounded-full bg-primary-500/10 dark:bg-primary-500/20 flex items-center justify-center">
                                <span class="text-sm font-medium text-primary-600 dark:text-primary-400">
                                    {{ strtoupper(substr($message['name'], 0, 1)) }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0 space-y-1.5">
                            <!-- Header -->
                            <div class="flex items-center justify-between gap-2">
                                <h3
                                    class="text-sm font-medium text-gray-800 dark:text-gray-200 group-hover:text-primary-600 dark:group-hover:text-primary-400 truncate transition-colors">
                                    {{ $message['name'] }}
                                </h3>
                                <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    {{ $message['time'] }}
                                </span>
                            </div>

                            <!-- Email -->
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                {{ $message['email'] }}
                            </p>

                            <!-- Subject -->
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 truncate">
                                {{ $message['subject'] }}
                            </p>

                            <!-- Message Preview -->
                            @if (isset($message['message']) && !empty($message['message']))
                                <p class="text-xs text-gray-600 dark:text-gray-300 line-clamp-2">
                                    {{ Str::limit($message['message'], 120) }}
                                </p>
                            @endif

                            <!-- Status Badges -->
                            <div class="flex items-center gap-2 pt-1">
                                @if (!$message['is_read'])
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-danger-500/10 text-danger-700 dark:bg-danger-500/20 dark:text-danger-400">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        New
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-success-500/10 text-success-700 dark:bg-success-500/20 dark:text-success-400">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Read
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                    <svg class="mx-auto h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <p class="mt-2">No recent messages found</p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
