@extends('admin-dashboard.layouts.app')
@section('title', 'Record Donation')
@section('header', 'Record Donation')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin-dashboard.donations.store') }}" method="post" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5"><div><label class="block text-sm font-medium text-admin-dark mb-1">Donor name *</label><input type="text" name="donor_name" value="{{ old('donor_name') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">@error('donor_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror</div><div><label class="block text-sm font-medium text-admin-dark mb-1">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5"><div><label class="block text-sm font-medium text-admin-dark mb-1">Amount *</label><input type="number" name="amount" value="{{ old('amount') }}" step="0.01" min="0" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div><div><label class="block text-sm font-medium text-admin-dark mb-1">Currency</label><input type="text" name="currency" value="{{ old('currency', 'KES') }}" maxlength="3" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5"><div><label class="block text-sm font-medium text-admin-dark mb-1">Campaign</label><input type="text" name="campaign" value="{{ old('campaign') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div><div><label class="block text-sm font-medium text-admin-dark mb-1">Payment method</label><input type="text" name="payment_method" value="{{ old('payment_method') }}" placeholder="M-Pesa, Stripe, etc." class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div></div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Donation date</label><input type="date" name="donated_at" value="{{ old('donated_at', date('Y-m-d')) }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Notes</label><textarea name="notes" rows="2" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">{{ old('notes') }}</textarea></div>
            <div class="flex gap-3"><a href="{{ route('admin-dashboard.donations.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-admin-dark hover:bg-admin-bg">Cancel</a><button type="submit" class="px-4 py-2 rounded-lg bg-admin-coral text-white font-medium hover:bg-admin-coral-dark">Save</button></div>
        </form>
    </div>
@endsection
