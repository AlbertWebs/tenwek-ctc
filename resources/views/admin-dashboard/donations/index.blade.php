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
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-admin-muted uppercase sm:px-6">Donor</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-admin-muted uppercase sm:px-6">Amount</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-admin-muted uppercase sm:px-6">Date</th>
                <th class="px-4 py-3 text-right text-xs font-medium text-admin-muted uppercase sm:px-6">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($donations as $d)
                    <tr class="hover:bg-admin-bg/50">
                        <td class="px-4 py-3 text-sm font-medium text-admin-dark sm:px-6">{{ $d->donor_name }}</td>
                        <td class="px-4 py-3 text-sm text-admin-muted sm:px-6">{{ number_format($d->amount, 0) }} {{ $d->currency }}</td>
                        <td class="px-4 py-3 text-sm text-admin-muted sm:px-6">{{ $d->donated_at?->format('M j, Y') ?? $d->created_at->format('M j, Y') }}</td>
                        <td class="px-4 py-3 text-right text-sm sm:px-6">
                            <a href="{{ route('admin-dashboard.donations.edit', $d) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin-dashboard.donations.destroy', $d) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-admin-coral hover:underline">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-admin-muted">No donations. <a href="{{ route('admin-dashboard.donations.create') }}" class="text-admin-teal hover:underline">Record one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($donations->hasPages())<div class="px-4 py-3 border-t border-gray-200">{{ $donations->links() }}</div>@endif
    </div>
@endsection
