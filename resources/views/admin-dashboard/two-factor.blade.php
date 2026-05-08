<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Two-Step Verification — {{ config('ctc.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-admin-bg flex items-center justify-center p-4 font-sans antialiased">
    <div class="w-full max-w-md">
        <div class="rounded-2xl bg-admin-surface shadow-lg border border-gray-200 p-8">
            <div class="text-center mb-6">
                <h1 class="text-xl font-bold text-gray-900">Two-step verification</h1>
                <p class="text-sm text-gray-500 mt-1">We sent a 6‑digit code to <span class="font-medium text-gray-700">{{ $email }}</span></p>
            </div>

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
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

            <form method="post" action="{{ route('admin-dashboard.two-factor.verify') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Verification code</label>
                    <input
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="6"
                        name="code"
                        id="code"
                        required
                        autofocus
                        class="w-full tracking-[0.4em] text-center rounded-lg border border-gray-300 px-4 py-3 text-lg focus:ring-2 focus:ring-admin-teal focus:border-admin-teal"
                        placeholder="••••••"
                    >
                </div>

                <button type="submit" class="w-full rounded-lg bg-admin-teal text-white font-medium py-2.5 hover:bg-admin-teal-dark transition-colors">
                    Verify & continue
                </button>
            </form>

            <form method="post" action="{{ route('admin-dashboard.two-factor.resend') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full rounded-lg border border-gray-300 bg-white text-gray-700 font-medium py-2.5 hover:bg-gray-50 transition-colors">
                    Resend code
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-gray-500">
            <a href="{{ route('admin-dashboard.login') }}" class="text-admin-teal hover:underline">Back to login</a>
        </p>
    </div>
</body>
</html>

