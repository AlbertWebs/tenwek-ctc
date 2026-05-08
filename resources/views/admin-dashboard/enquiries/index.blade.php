@extends('admin-dashboard.layouts.app')
@section('title', 'Contact & Enquiries')
@section('header', 'Contact & Enquiries')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex flex-wrap justify-between items-center gap-3 sm:px-6">
            <p class="text-sm text-admin-muted">{{ $enquiries->total() }} enquiry(ies)</p>
            <form action="{{ route('admin-dashboard.enquiries.index') }}" method="get" class="flex flex-wrap gap-2">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search..." class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-admin-teal w-36 sm:w-48">
                <select name="status" class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-admin-teal">
                    <option value="">All statuses</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                <button type="submit" class="rounded-lg bg-admin-teal text-white px-3 py-1.5 text-sm font-medium hover:bg-admin-teal-dark">Filter</button>
            </form>
        </div>
        <div class="overflow-x-auto">
        <table class="admin-table min-w-full">
            <thead><tr>
                <th class="text-left">From</th>
                <th class="text-left">Subject / Source</th>
                <th class="text-left">Status</th>
                <th class="text-left">Date</th>
                <th class="text-right">Actions</th>
            </tr></thead>
            <tbody class="bg-white">
                @forelse($enquiries as $e)
                    <tr class="hover:bg-admin-bg/50 {{ $e->status === 'new' ? 'bg-admin-gold/5' : '' }}">
                        <td class="text-sm font-medium text-admin-dark">{{ $e->name }}<br><span class="text-admin-muted text-xs">{{ $e->email }}</span></td>
                        <td class="text-sm text-admin-muted">{{ Str::limit($e->subject ?? $e->message, 40) }} @if($e->source)<span class="text-xs">({{ $e->source }})</span>@endif</td>
                        <td class="text-sm"><span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $e->status === 'new' ? 'bg-admin-gold/20 text-admin-gold-dark' : 'bg-gray-100 text-admin-muted' }}">{{ $e->status }}</span></td>
                        <td class="text-sm text-admin-muted">{{ $e->created_at->format('M j, Y H:i') }}</td>
                        <td class="text-right text-sm">
                            <a href="{{ route('admin-dashboard.enquiries.show', $e) }}" class="text-admin-teal hover:underline mr-3">View</a>
                            <form action="{{ route('admin-dashboard.enquiries.destroy', $e) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-admin-coral hover:underline">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-admin-muted py-10">No enquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        @if($enquiries->hasPages())<div class="px-4 py-3 border-t border-gray-200">{{ $enquiries->links() }}</div>@endif
    </div>
@endsection
