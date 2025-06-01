<!-- header top -->
<div class="header_top dn-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-7">
                <div class="text-center header_top_contact_opening_widget text-md-start">
                    <ul class="mb0">
                        <li class="list-inline-item"><a href="#"><span
                                    class="flaticon-phone-call"></span>0363-2787803</a>
                        </li>
                        <li class="list-inline-item">
                            <a target="_blank" href="https://maps.app.goo.gl/r4itKV18H6mecsfq6">
                                <span class="flaticon-map"></span>Desa Bugbug, Karangasem, Bali 80811
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="flaticon-clock"></span>
                                Mon - Fri 7:30 - 16:00
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-xl-5">
                <div class="text-center header_top_social_widgets text-md-end">
                    <ul class="m0">
                        <li class="list-inline-item"><a href="https://www.facebook.com/BPIU2K/" target="_blank"><span
                                    class="fab fa-facebook-f"></span></a>
                        </li>
                        <li class="list-inline-item"><a href="https://x.com/bpiu2k_k" target="_blank"><span
                                    class="fab fa-twitter"></span></a></li>
                        <li class="list-inline-item"><a href="https://www.instagram.com/bpiu2k/" target="_blank"><span
                                    class="fab fa-instagram"></span></a></li>
                        <li class="list-inline-item"><a href="http://www.youtube.com/@bpiu2kkarangasem939"
                                target="_blank"><span class="fab fa-youtube"></span></a></li>

                        <li class="list-inline-item position-relative" x-data="{
                            currentLocale: '{{ app()->getLocale() }}',
                            supportedLocales: {
                                'en': { flag: '🇺🇸', url: '{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}' },
                                'id': { flag: '🇮🇩', url: '{{ LaravelLocalization::getLocalizedURL('id', null, [], true) }}' }
                            }
                        }" x-init="currentLocale = '{{ app()->getLocale() }}'">

                            <template x-for="(locale, code) in supportedLocales" :key="code">
                                <span x-show="currentLocale !== code" style="cursor: pointer;"
                                    class="opacity-100 text-decoration-none hover-opacity"
                                    @click="currentLocale = code;window.location.href = locale.url;"
                                    :title="code === 'id' ? 'Ganti ke Bahasa Indonesia' : 'Switch to English'">
                                    <span x-text="supportedLocales[currentLocale].flag"></span>
                                </span>
                            </template>
                        </li>

                        @if (Route::has('login'))
                            @auth
                                <li class="list-inline-item">
                                    <a href="{{ url('/dashboard') }}">Dasboard</a>
                                </li>
                            @else
                                <li class="list-inline-item">
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="list-inline-item">
                                        <a href="{{ route('register') }}">
                                            Register
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
