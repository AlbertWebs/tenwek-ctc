@extends('admin-dashboard.layouts.app')
@section('title', 'Donations')
@section('header', 'Support / Donations Management')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex flex-wrap justify-between items-center gap-3 sm:px-6">
            <p class="text-sm text-admin-muted">{{ $donations->total() }} donation(s)</p>
            <form action="{{ route('admin-dashboard.donations.index') }}" method="get" class="flex gap-2">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search donor..." class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-admin-teal w-40 sm:w-56">
                <button type="submit" class="rounded-lg bg-admin-teal text-white px-3 py-1.5 text-sm font-medium hover:bg-admin-teal-dark">Search</button>
            </form>
            <a href="{{ route('admin-dashboard.donations.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-coral text-white hover:bg-admin-coral-dark text-sm">Record donation</a>
        </div>
        <div class="overflow-x-auto">
        <table class="admin-table min-w-full">
            <thead><tr>
                <th class="text-left">Donor</th>
                <th class="text-left">Amount</th>
                <th class="text-left">Channel</th>
                <th class="text-left">Date</th>
                <th class="text-right">Actions</th>
            </tr></thead>
            <tbody class="bg-white">
                @forelse($donations as $d)
                    <tr class="hover:bg-admin-bg/50">
                        <td class="text-sm font-medium text-admin-dark">{{ $d->donor_name }}</td>
                        <td class="text-sm text-admin-muted">{{ number_format($d->amount, 0) }} {{ $d->currency }}</td>
                        <td class="text-sm text-admin-muted">
                            <span class="inline-flex items-center rounded-full bg-admin-bg px-2.5 py-0.5 text-xs font-medium text-admin-dark">
                                {{ $d->payment_method ?: '—' }}
                            </span>
                        </td>
                        <td class="text-sm text-admin-muted">{{ $d->donated_at?->format('M j, Y') ?? $d->created_at->format('M j, Y') }}</td>
                        <td class="text-right text-sm">
                            <a href="{{ route('admin-dashboard.donations.edit', $d) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin-dashboard.donations.destroy', $d) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-admin-coral hover:underline">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-admin-muted py-10">No donations. <a href="{{ route('admin-dashboard.donations.create') }}" class="text-admin-teal hover:underline">Record one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        @if($donations->hasPages())<div class="px-4 py-3 border-t border-gray-200">{{ $donations->links() }}</div>@endif
    </div>
@endsection
