@extends('admin-dashboard.layouts.app')

@section('title', 'History milestones')
@section('header', 'History milestones')

@section('content')
    <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3 sm:px-6">
            <p class="text-sm text-gray-600">{{ $milestones->count() }} milestone(s)</p>
            <a href="{{ route('admin-dashboard.history-milestones.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">
                Add milestone
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table min-w-full">
                <thead>
                    <tr>
                        <th class="text-left">Year</th>
                        <th class="text-left">Title</th>
                        <th class="text-left">Visible</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($milestones as $m)
                        <tr class="hover:bg-admin-bg/50">
                            <td class="text-sm text-gray-700">{{ $m->year ?? '-' }}</td>
                            <td class="text-sm font-medium text-gray-900">{{ $m->title }}</td>
                            <td class="text-sm">
                                @if($m->is_visible)<span class="text-green-600">Yes</span>@else<span class="text-gray-400">No</span>@endif
                            </td>
                            <td class="text-right text-sm">
                                <a href="{{ route('admin-dashboard.history-milestones.edit', $m) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                                <form action="{{ route('admin-dashboard.history-milestones.destroy', $m) }}" method="post" class="inline" onsubmit="return confirm('Delete this milestone?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-10">
                                No milestones yet. <a href="{{ route('admin-dashboard.history-milestones.create') }}" class="text-admin-teal hover:underline">Add one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

