@extends('admin-dashboard.layouts.app')
@section('title', 'Add Booking')
@section('header', 'Add Booking / Appointment')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin-dashboard.bookings.store') }}" method="post" class="space-y-5">
            @csrf
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Patient name *</label><input type="text" name="patient_name" value="{{ old('patient_name') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">@error('patient_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5"><div><label class="block text-sm font-medium text-admin-dark mb-1">Email *</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div><div><label class="block text-sm font-medium text-admin-dark mb-1">Phone</label><input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5"><div><label class="block text-sm font-medium text-admin-dark mb-1">Requested date</label><input type="date" name="requested_date" value="{{ old('requested_date') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div><div><label class="block text-sm font-medium text-admin-dark mb-1">Status</label><select name="status" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"><option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>Pending</option><option value="confirmed">Confirmed</option><option value="cancelled">Cancelled</option><option value="completed">Completed</option></select></div></div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Notes</label><textarea name="notes" rows="3" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">{{ old('notes') }}</textarea></div>
            <div class="flex gap-3"><a href="{{ route('admin-dashboard.bookings.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-admin-dark hover:bg-admin-bg">Cancel</a><button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button></div>
        </form>
    </div>
@endsection
