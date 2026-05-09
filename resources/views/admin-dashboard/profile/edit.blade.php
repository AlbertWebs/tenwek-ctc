@extends('admin-dashboard.layouts.app')

@section('title', 'My profile')
@section('header', 'My profile')

@section('content')
    @if($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800 shadow-sm">
            <p class="font-medium">Please fix the following:</p>
            <ul class="mt-2 list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-5xl space-y-6">
        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h2 class="text-lg font-semibold text-admin-dark mb-1">Account</h2>
            <p class="text-sm text-admin-muted">Update your personal details for the admin dashboard.</p>

            <form method="post" action="{{ route('admin-dashboard.profile.update') }}" class="mt-6 grid gap-4 sm:grid-cols-2 max-w-3xl">
                @csrf
                @method('PUT')

                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-semibold text-admin-dark">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-admin-dark">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div>
                    <label for="phone_number" class="block text-sm font-semibold text-admin-dark">Phone number (optional)</label>
                    <input id="phone_number" name="phone_number" type="text" value="{{ old('phone_number', $user->phone_number) }}"
                           placeholder="+2547..."
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div class="sm:col-span-2 flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">
                        Save profile
                    </button>
                </div>
            </form>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white shadow-sm p-6">
            <h2 class="text-lg font-semibold text-admin-dark mb-1">Password</h2>
            <p class="text-sm text-admin-muted">Choose a strong password (minimum 8 characters).</p>

            <form method="post" action="{{ route('admin-dashboard.profile.update-password') }}" class="mt-6 grid gap-4 sm:grid-cols-2 max-w-3xl">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-semibold text-admin-dark">Current password</label>
                    <input id="current_password" name="current_password" type="password" required autocomplete="current-password"
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div></div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-admin-dark">New password</label>
                    <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password"
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-admin-dark">Confirm new password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password"
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div class="sm:col-span-2 flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">
                        Update password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

