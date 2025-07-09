<div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto bg-white dark:bg-gray-800"
    style="display: none;">
    <div class="container px-4 py-6 mx-auto sm:py-8">
        <div class="flex items-center justify-between mb-6 sm:mb-8">
            <img src="{{ $appInfo['companyLogo'] }}" alt="{{ $appInfo['company_name'] }} Logo" class="h-8 sm:h-10">
            <button @click="mobileMenuOpen = false"
                class="text-gray-500 dark:text-gray-300 hover:text-primary dark:hover:text-primary">
                <i class="text-lg sm:text-xl fas fa-times"></i>
            </button>
        </div>

        <x-navigation type="mobile" />
    </div>
</div>
