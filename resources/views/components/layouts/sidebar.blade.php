<div x-show="sidebarOpen" @click.away="sidebarOpen = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
    class="fixed inset-y-0 right-0 z-50 overflow-y-auto bg-white shadow-xl w-80">
    <div class="p-6">
        <button @click="sidebarOpen = false"
            class="absolute text-gray-500 top-4 right-4 hover:text-gray-700 focus:outline-none">
            <i class="text-xl fas fa-times"></i>
        </button>

        <div class="mt-16 space-y-8">
            <div>
                <h3 class="mb-4 text-xl font-bold">Quick contact info</h3>
                <p class="text-sm text-gray-600">Sebagai pusat pembenihan udang vaname terkemuka di Bali, kami siap
                    membantu Anda dengan solusi akuakultur berbasis bioteknologi.</p>
            </div>

            <div>
                <h5 class="font-bold text-gray-800">CONTACT</h5>
                <a href="tel:0363-2787803" class="text-sm font-semibold text-blue-600 hover:underline">0363-2787803</a>
                <a href="mailto:bpiu2k@gmail.com"
                    class="block text-sm text-gray-600 hover:underline">bpiu2k@gmail.com</a>
            </div>

            <div>
                <h5 class="font-bold text-gray-800">OFFICE</h5>
                <a href="https://maps.app.goo.gl/r4itKV18H6mecsfq6" target="_blank" rel="noopener noreferrer"
                    class="text-sm text-gray-600 hover:underline">
                    Desa Bugbug —<br>Karangasem, <br>Bali 80811
                </a>
            </div>

            <div>
                <h5 class="font-bold text-gray-800">OPENING HOURS</h5>
                <p class="text-sm text-gray-600">
                    Monday – Thursday : 07:30AM – 16:00PM<br>
                    Friday : 07:30AM – 16:30PM<br>
                    Sunday : Closed
                </p>
            </div>
        </div>
    </div>
</div>
