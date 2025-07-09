<header class="sticky top-0 z-40 transition-all duration-300 bg-transparent">
    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-between py-4">
            <a href="{{ route('home') }}" class="flex items-center mr-auto">
                <img src="{{ $appInfo['companyLogo'] }}" alt="{{ $appInfo['company_name'] }} Logo" class="h-10">
            </a>

            <!-- Desktop Menu -->
            <x-navigation type="desktop" />

            <button @click="sidebarOpen = true"
                class="hidden md:block ml-4 text-white transition-colors hover:text-primary">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = true" class="text-white md:hidden hover:text-primary">
                <i class="text-xl text-white fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
