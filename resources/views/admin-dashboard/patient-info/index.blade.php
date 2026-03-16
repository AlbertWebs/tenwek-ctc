@extends('admin-dashboard.layouts.app')
@section('title', 'Patient Information')
@section('header', 'Patient Information Management')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center sm:px-6">
            <p class="text-sm text-admin-muted">{{ $blocks->count() }} block(s)</p>
            <a href="{{ route('admin-dashboard.patient-info.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">Add block</a>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-admin-muted uppercase sm:px-6">Key</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-admin-muted uppercase sm:px-6">Title</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-admin-muted uppercase sm:px-6">Visible</th>
                <th class="px-4 py-3 text-right text-xs font-medium text-admin-muted uppercase sm:px-6">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($blocks as $b)
                    <tr class="hover:bg-admin-bg/50">
                        <td class="px-4 py-3 text-sm font-medium text-admin-dark sm:px-6">{{ $b->key }}</td>
                        <td class="px-4 py-3 text-sm text-admin-muted sm:px-6">{{ $b->title }}</td>
                        <td class="px-4 py-3 text-sm sm:px-6">{{ $b->is_visible ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-3 text-right text-sm sm:px-6">
                            <a href="{{ route('admin-dashboard.patient-info.edit', $b) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin-dashboard.patient-info.destroy', $b) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-admin-coral hover:underline">Delete</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-admin-muted">No blocks. <a href="{{ route('admin-dashboard.patient-info.create') }}" class="text-admin-teal hover:underline">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
