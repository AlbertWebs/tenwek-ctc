@extends('admin-dashboard.layouts.app')

@section('title', 'Two-factor authentication')
@section('header', 'Two-factor authentication')

@section('content')
    <div class="max-w-4xl space-y-6">
        @if(session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h2 class="text-lg font-semibold text-admin-dark mb-1">Admin dashboard 2FA</h2>
            <p class="text-sm text-admin-muted mb-6">
                These settings control whether admins must complete a second step after password login. All options are off by default.
            </p>

            <form method="post" action="{{ route('admin-dashboard.security.two-factor.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-3">
                    <label class="flex items-start gap-3">
                        <input type="checkbox" name="enabled" value="1" @checked(old('enabled', $twoFactorEnabled)) class="mt-1 rounded border-gray-300 text-admin-teal focus:ring-admin-teal">
                        <span>
                            <span class="block text-sm font-semibold text-admin-dark">Require two-factor for admin login</span>
                            <span class="block text-sm text-admin-muted">If enabled, admins must enter a 6-digit code after logging in.</span>
                        </span>
                    </label>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-4">
                    <p class="text-sm font-semibold text-admin-dark">Delivery methods</p>
                    <p class="mt-1 text-sm text-admin-muted">Choose how verification codes are sent.</p>

                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <label class="flex items-start gap-3">
                            <input type="checkbox" name="email_enabled" value="1" @checked(old('email_enabled', $twoFactorEmailEnabled)) class="mt-1 rounded border-gray-300 text-admin-teal focus:ring-admin-teal">
                            <span>
                                <span class="block text-sm font-medium text-admin-dark">Email</span>
                                <span class="block text-sm text-admin-muted">Send codes to the admin’s email address.</span>
                            </span>
                        </label>

                        <label class="flex items-start gap-3">
                            <input type="checkbox" name="sms_enabled" value="1" @checked(old('sms_enabled', $twoFactorSmsEnabled)) class="mt-1 rounded border-gray-300 text-admin-teal focus:ring-admin-teal">
                            <span>
                                <span class="block text-sm font-medium text-admin-dark">SMS</span>
                                <span class="block text-sm text-admin-muted">Send codes to the admin’s phone number (if set on the user account).</span>
                            </span>
                        </label>
                    </div>

                    <p class="mt-3 text-xs text-admin-muted">
                        Note: If you enable 2FA, you must enable at least one delivery method.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">
                        Save settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

