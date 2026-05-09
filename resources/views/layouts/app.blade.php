<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription ?? config('ctc.tagline') }}">

    @stack('head')

    <title>@hasSection('title')@yield('title') | @endif{{ config('ctc.name') }} | {{ config('ctc.hospital') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="min-h-screen bg-white text-gray-800 antialiased {{ request()->routeIs('home') ? 'ctc-home' : '' }} @stack('body_class')"
    data-ctc-site="public"
    x-data="{ mobileMenuOpen: false }"
>
    <div id="ctc-site-header" class="ctc-site-header" role="banner">
        @include('components.top-header')
    </div>

    @yield('hero')
    <div id="ctc-navbar-sentinel" aria-hidden="true"></div>
    @include('components.navbar')
    <div id="ctc-navbar-spacer" aria-hidden="true" style="height: 0;"></div>

    <main id="ctc-main" class="min-h-screen">
        @yield('content')
    </main>

    @include('components.scroll-to-top')
    @include('components.footer')
    @stack('scripts')
</body>
</html>
