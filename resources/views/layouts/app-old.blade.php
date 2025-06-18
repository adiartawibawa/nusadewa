<!DOCTYPE html>
<html lang="id" dir="ltr" itemscope itemtype="https://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', 'Deskripsi default tentang Nusa Dewa')">
    <meta name="keywords" content="@yield('meta_keywords', 'keyword1, keyword2, keyword3')">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <!-- Title -->
    <title>@yield('title', 'Nusa Dewa - Judul Halaman Default')</title>

    <!-- Favicon -->
    <link rel="icon" href="https://bpiu2k.online/img/favicon.ico" sizes="128x128" type="image/x-icon">
    <link rel="shortcut icon" href="https://bpiu2k.online/img/favicon.ico" sizes="128x128">

    <!-- Open Graph / Social Media Meta Tags -->
    {{-- <meta property="og:title" content="@yield('og_title', @yield('title', 'Nusa Dewa - Judul Halaman Default'))">
    <meta property="og:description" content="@yield('og_description', @yield('meta_description', 'Deskripsi default tentang Nusa Dewa'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og_image', asset('assets/assets/images/default-social.jpg'))">
    <meta property="og:locale" content="id_ID"> --}}

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">

    @stack('styles')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="wrapper ovh">
        <div class="preloader"></div>

        @include('components.sidebar')

        @include('components.header-top')

        @include('components.main-header')

        @include('components.main-header-mobile')

        <main>
            @yield('content')

            @include('components.footer')
        </main>

        <a class="scrollToHome" href="#"><i class="fas fa-arrow-up"></i></a>

        @include('components.modals')
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mmenu.all.js') }}"></script>
    <script src="{{ asset('assets/js/ace-responsive-menu.js') }}"></script>
    <script src="{{ asset('assets/js/isotop.js') }}"></script>
    <script src="{{ asset('assets/js/snackbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/js/scrollto.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-scrolltofixed-min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/progressbar.js') }}"></script>
    <script src="{{ asset('assets/js/slider.js') }}"></script>
    <script src="{{ asset('assets/js/timepicker.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>

    <!-- Custom script for all pages -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script src="//unpkg.com/alpinejs" defer></script>

    @stack('scripts')
</body>

</html>
