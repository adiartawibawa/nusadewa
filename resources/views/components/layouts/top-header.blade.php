<div class="relative z-30 hidden py-2 bg-transparent border-b border-gray-200 border-opacity-20 md:block">
    <div class="container px-4 mx-auto">
        <div class="flex flex-col items-center justify-between md:flex-row">
            <div class="flex flex-wrap justify-center gap-4 mb-2 text-xs md:justify-start md:mb-0">
                <a href="tel:0363-2787803" class="flex items-center text-white hover:text-blue-300">
                    <i class="mr-2 fas fa-phone-alt"></i>0363-2787803
                </a>
                <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank" rel="noopener noreferrer"
                    class="flex items-center text-white hover:text-blue-300">
                    <i class="mr-2 fas fa-map-marker-alt"></i>Desa Bugbug, Karangasem, Bali 80811
                </a>
                <a href="#" class="flex items-center text-white hover:text-blue-300">
                    <i class="mr-2 far fa-clock"></i>Mon - Fri 7:30 - 16:00
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <div class="flex space-x-3">
                    <a href="https://www.facebook.com/BPIU2K/" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-blue-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://x.com/bpiu2k_k" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-blue-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/bpiu2k/" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-blue-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="http://www.youtube.com/@bpiu2kkarangasem939" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-red-300">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>

                <div class="ml-2">
                    <button x-show="currentLocale === 'en'" {{-- @click="currentLocale = 'id'; window.location.href = '{{ route('language.switch', 'id') }}'" --}}
                        class="text-white hover:text-blue-300 focus:outline-none" title="Switch to Bahasa Indonesia">
                        🇮🇩
                    </button>
                    <button x-show="currentLocale === 'id'" {{-- @click="currentLocale = 'en'; window.location.href = '{{ route('language.switch', 'en') }}'" --}}
                        class="text-white hover:text-blue-300 focus:outline-none" title="Switch to English">
                        🇺🇸
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
