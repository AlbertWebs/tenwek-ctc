<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — Admin — {{ config('ctc.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=source-sans-3:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="min-h-screen bg-admin-bg text-admin-dark antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        {{-- Sidebar: teal primary --}}
        <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-admin-teal text-white transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-auto"
             :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="flex h-16 items-center justify-between px-4 border-b border-white/15 lg:px-5">
                <span class="font-bold text-white truncate">{{ config('ctc.name') }}</span>
                <button type="button" @click="sidebarOpen = false" class="lg:hidden p-2 rounded-lg hover:bg-white/10 text-white" aria-label="Close menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            @include('admin-dashboard.components.sidebar')
        </aside>

        {{-- Overlay for mobile --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-30 bg-black/50 lg:hidden" @click="sidebarOpen = false" x-cloak></div>

        <div class="flex-1 flex flex-col min-w-0">
            {{-- Topbar: white with coral/gold accents --}}
            <header class="sticky top-0 z-20 flex h-16 shrink-0 items-center justify-between gap-4 border-b border-gray-200 bg-admin-surface px-4 shadow-sm lg:px-8">
                <button type="button" @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-admin-muted hover:bg-admin-bg hover:text-admin-teal transition-colors" aria-label="Open menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-lg font-semibold text-admin-dark truncate">@yield('header', 'Dashboard')</h1>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-admin-muted hidden sm:inline">{{ auth()->user()->name }}</span>
                    <span class="rounded-full bg-admin-gold/20 text-admin-gold-dark px-2.5 py-0.5 text-xs font-medium">{{ auth()->user()->role?->name ?? 'No role' }}</span>
                    <form method="post" action="{{ route('admin-dashboard.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-admin-coral hover:text-admin-coral-dark font-medium transition-colors">Log out</button>
                    </form>
                </div>
            </header>

            {{-- Main --}}
            <main class="flex-1 p-4 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800 shadow-sm flex items-center gap-2">
                        <svg class="w-5 h-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800 shadow-sm">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
