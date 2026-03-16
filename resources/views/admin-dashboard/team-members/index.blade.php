@extends('admin-dashboard.layouts.app')

@section('title', 'Team')
@section('header', 'Team members')

@section('content')
    <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3 sm:px-6">
            <p class="text-sm text-gray-600">{{ $members->count() }} member(s)</p>
            <a href="{{ route('admin-dashboard.team-members.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">
                Add member
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Title</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Visible</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($members as $member)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 sm:px-6">{{ $member->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600 sm:px-6">{{ $member->title }}</td>
                            <td class="px-4 py-3 text-sm sm:px-6">
                                @if($member->is_visible)
                                    <span class="text-green-600">Yes</span>
                                @else
                                    <span class="text-gray-400">No</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right text-sm sm:px-6">
                                <a href="{{ route('admin-dashboard.team-members.edit', $member) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                                <form action="{{ route('admin-dashboard.team-members.destroy', $member) }}" method="post" class="inline" onsubmit="return confirm('Delete this team member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500 sm:px-6">No team members yet. <a href="{{ route('admin-dashboard.team-members.create') }}" class="text-admin-teal hover:underline">Add one</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
