<div class="space-y-3">
    <div class="px-4 py-2 rounded-t-lg bg-gray-50 dark:bg-gray-800">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Latest Subscribers</h3>
    </div>

    <div class="space-y-2">
        @foreach ($subscribers as $subscriber)
            <div class="p-3 border border-gray-200 rounded-lg dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $subscriber->email }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $subscriber->created_at->diffForHumans() }}
                            @if ($subscriber->email_verified_at)
                                • <span class="text-primary-600 dark:text-primary-400">Verified</span>
                            @endif
                        </p>
                    </div>
                    <span
                        class="px-2 py-1 text-xs rounded-full
                        {{ $subscriber->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                        {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="px-4 py-2 text-right rounded-b-lg bg-gray-50 dark:bg-gray-800">
        <a href="{{ route('filament.admin.communications.resources.newsletter-subscribers.index') }}"
            class="text-sm font-medium transition-colors text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300">
            View all subscribers &rarr;
        </a>
    </div>
</div>
