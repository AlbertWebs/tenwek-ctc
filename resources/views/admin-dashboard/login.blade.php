<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — {{ config('ctc.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=source-sans-3:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="min-h-screen bg-admin-bg flex items-center justify-center p-4 font-sans antialiased">
    <div class="w-full max-w-md">
        <div class="rounded-2xl bg-admin-surface shadow-lg border border-gray-200 p-8">
            <div class="text-center mb-8">
                <h1 class="text-xl font-bold text-gray-900">{{ config('ctc.name') }}</h1>
                <p class="text-sm text-gray-500 mt-1">Admin dashboard</p>
            </div>

            @if(session('error'))
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('admin-dashboard.login.attempt') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                           class="rounded border-gray-300 text-admin-teal focus:ring-admin-teal">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
                <button type="submit"
                        class="w-full rounded-lg bg-admin-teal text-white font-medium py-2.5 hover:bg-admin-teal-dark transition-colors">
                    Log in
                </button>
            </form>
        </div>
        <p class="mt-6 text-center text-sm text-gray-500">
            <a href="{{ url('/') }}" class="text-admin-teal hover:underline">Back to site</a>
        </p>
    </div>
</body>
</html>
