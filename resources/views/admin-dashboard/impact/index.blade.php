@extends('admin-dashboard.layouts.app')
@section('title', 'Impact Stories')
@section('header', 'Impact Stories Management')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center sm:px-6">
            <p class="text-sm text-admin-muted">{{ $stories->count() }} story(ies)</p>
            <a href="{{ route('admin-dashboard.impact.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">Add story</a>
        </div>
        <div class="overflow-x-auto">
        <table class="admin-table min-w-full">
            <thead><tr>
                <th class="text-left">Title</th>
                <th class="text-left">Date</th>
                <th class="text-left">Visible</th>
                <th class="text-right">Actions</th>
            </tr></thead>
            <tbody class="bg-white">
                @forelse($stories as $s)
                    <tr class="hover:bg-admin-bg/50">
                        <td class="text-sm font-medium text-admin-dark">{{ Str::limit($s->title, 45) }}</td>
                        <td class="text-sm text-admin-muted">{{ $s->story_date?->format('M j, Y') ?? '—' }}</td>
                        <td class="text-sm">{{ $s->is_visible ? 'Yes' : 'No' }}</td>
                        <td class="text-right text-sm">
                            <a href="{{ route('admin-dashboard.impact.edit', $s) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin-dashboard.impact.destroy', $s) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-admin-coral hover:underline">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-admin-muted py-10">No stories. <a href="{{ route('admin-dashboard.impact.create') }}" class="text-admin-teal hover:underline">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
@endsection
