@extends('admin-dashboard.layouts.app')
@section('title', 'Bookings / Appointments')
@section('header', 'Bookings / Appointments')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex flex-wrap justify-between items-center gap-3 sm:px-6">
            <p class="text-sm text-admin-muted">{{ $bookings->total() }} booking(s)</p>
            <form action="{{ route('admin-dashboard.bookings.index') }}" method="get" class="flex flex-wrap gap-2">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search patient..." class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-admin-teal w-36 sm:w-48">
                <select name="status" class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-admin-teal">
                    <option value="">All statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit" class="rounded-lg bg-admin-teal text-white px-3 py-1.5 text-sm font-medium hover:bg-admin-teal-dark">Filter</button>
            </form>
            <a href="{{ route('admin-dashboard.bookings.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">Add booking</a>
        </div>
        <div class="overflow-x-auto">
        <table class="admin-table min-w-full">
            <thead><tr>
                <th class="text-left">Patient</th>
                <th class="text-left">Requested date</th>
                <th class="text-left">Status</th>
                <th class="text-right">Actions</th>
            </tr></thead>
            <tbody class="bg-white">
                @forelse($bookings as $b)
                    <tr class="hover:bg-admin-bg/50">
                        <td class="text-sm font-medium text-admin-dark">{{ $b->patient_name }}<br><span class="text-admin-muted text-xs">{{ $b->email }}</span></td>
                        <td class="text-sm text-admin-muted">{{ $b->requested_date?->format('M j, Y') ?? '—' }}</td>
                        <td class="text-sm"><span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $b->status === 'pending' ? 'bg-admin-gold/20' : ($b->status === 'confirmed' ? 'bg-admin-teal/20 text-admin-teal-dark' : 'bg-gray-100') }}">{{ $b->status }}</span></td>
                        <td class="text-right text-sm">
                            <a href="{{ route('admin-dashboard.bookings.edit', $b) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin-dashboard.bookings.destroy', $b) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-admin-coral hover:underline">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-admin-muted py-10">No bookings. <a href="{{ route('admin-dashboard.bookings.create') }}" class="text-admin-teal hover:underline">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        @if($bookings->hasPages())<div class="px-4 py-3 border-t border-gray-200">{{ $bookings->links() }}</div>@endif
    </div>
@endsection
