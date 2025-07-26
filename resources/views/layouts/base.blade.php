<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $seo['description'] ?? ($appInfo['company_description'] ?? '') }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? '' }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ $appInfo['companyLogo'] ?? '' }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo['title'] ?? ($appInfo['company_name'] ?? '') }} - {{ $title ?? 'Aquaculture Innovation' }}</title>

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Additional Styles -->
    @stack('styles')

    @livewireStyles
</head>

<body>

    @yield('content')

    @livewireScripts

    @stack('scripts')

</body>

</html>
