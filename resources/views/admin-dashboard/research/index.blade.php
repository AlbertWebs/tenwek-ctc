@extends('admin-dashboard.layouts.app')
@section('title', 'Research / Publications')
@section('header', 'Research / Publications Management')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center sm:px-6">
            <p class="text-sm text-admin-muted">{{ $items->total() }} publication(s)</p>
            <a href="{{ route('admin-dashboard.research.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">Add publication</a>
        </div>
        <div class="overflow-x-auto">
        <table class="admin-table min-w-full">
            <thead><tr>
                <th class="text-left">Title</th>
                <th class="text-left">Authors / Year</th>
                <th class="text-left">Visible</th>
                <th class="text-right">Actions</th>
            </tr></thead>
            <tbody class="bg-white">
                @forelse($items as $item)
                    <tr class="hover:bg-admin-bg/50">
                        <td class="text-sm font-medium text-admin-dark">{{ Str::limit($item->title, 50) }}</td>
                        <td class="text-sm text-admin-muted">{{ Str::limit($item->authors, 30) }} {{ $item->year ? "({$item->year})" : '' }}</td>
                        <td class="text-sm">{{ $item->is_visible ? 'Yes' : 'No' }}</td>
                        <td class="text-right text-sm">
                            <a href="{{ route('admin-dashboard.research.edit', $item) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin-dashboard.research.destroy', $item) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-admin-coral hover:underline">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-admin-muted py-10">No publications. <a href="{{ route('admin-dashboard.research.create') }}" class="text-admin-teal hover:underline">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        @if($items->hasPages())<div class="px-4 py-3 border-t border-gray-200">{{ $items->links() }}</div>@endif
    </div>
@endsection
