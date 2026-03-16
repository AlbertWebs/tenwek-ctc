<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription ?? config('ctc.tagline') }}">

    <title>@hasSection('title')@yield('title') | @endif{{ config('ctc.name') }} — {{ config('ctc.hospital') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=source-sans-3:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-gray-800 antialiased" x-data="{ mobileMenuOpen: false }">
    @include('components.top-header')
    @include('components.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('components.footer')
    @stack('scripts')
</body>
</html>
