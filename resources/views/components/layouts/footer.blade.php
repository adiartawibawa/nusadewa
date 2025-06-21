<footer class="pt-12 pb-6 text-white bg-gray-900">
    <div class="container px-4 mx-auto">
        <div class="flex flex-col items-center justify-between pb-6 mb-6 border-b border-gray-700 md:flex-row">
            <div class="mb-4 md:mb-0">
                <img src="https://bpiu2k.online/img/logo.png" alt="Nusa Dewa Logo" class="h-10">
            </div>
            <div class="flex flex-wrap justify-center gap-4 text-sm">
                <a href="{{ route('home') }}" class="transition-colors hover:text-primary">Home</a>
                <a href="#" class="transition-colors hover:text-primary">About Us</a>
                <a href="#" class="transition-colors hover:text-primary">Our
                    Products</a>
                <a href="#" class="transition-colors hover:text-primary">Research</a>
                <a href="#" class="transition-colors hover:text-primary">News</a>
                <a href="#" class="transition-colors hover:text-primary">Contact</a>
            </div>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-4">
            <div>
                <h5 class="mb-3 text-base font-semibold">HEADQUARTERS</h5>
                <p class="text-sm text-gray-400">Indonesia —<br>Nusa Dewa Aquaculture Center<br>
                    Jl. Raya Pemogan No. 123<br>
                    Denpasar, Bali 80361</p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">CONTACT US</h5>
                <p class="mb-1 text-sm text-gray-400">+62 361 123 4567</p>
                <p class="text-sm text-gray-400">info@nusadewa.com<br>
                    sales@nusadewa.com</p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">OPERATIONAL HOURS</h5>
                <p class="text-sm text-gray-400">Monday – Friday: 08:00AM – 05:00PM<br>
                    Saturday: 08:00AM – 12:00PM<br>
                    Sunday: Closed</p>
            </div>

            <div>
                <h5 class="mb-3 text-base font-semibold">NEWSLETTER</h5>
                <livewire:newsletter-subscription />
            </div>
        </div>

        <div class="flex flex-col items-center justify-between pt-4 border-t border-gray-700 md:flex-row">
            <p class="mb-3 text-xs text-gray-400 md:mb-0">&copy; {{ date('Y') }} Nusa Dewa Aquaculture. All
                Rights Reserved.
            </p>
            <div class="flex items-center space-x-4">
                <div href="#" class="text-xs text-gray-400">
                    Made with ❤️ by <a href="wa.me/+6281918175060" target="_blank" class="text-primary hover:underline">
                        PRADStudio
                    </a>
                </div>
            </div>
        </div>
</footer>
