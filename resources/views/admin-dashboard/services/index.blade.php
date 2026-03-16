@extends('admin-dashboard.layouts.app')

@section('title', 'Services')
@section('header', 'Services')

@section('content')
    <div class="rounded-xl bg-white border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3 sm:px-6">
            <p class="text-sm text-gray-600">{{ $services->count() }} service(s)</p>
            <a href="{{ route('admin-dashboard.services.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">
                Add service
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Visible</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider sm:px-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($services as $service)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 sm:px-6">{{ $service->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600 sm:px-6">{{ $service->category }}</td>
                            <td class="px-4 py-3 text-sm sm:px-6">
                                @if($service->is_visible)<span class="text-green-600">Yes</span>@else<span class="text-gray-400">No</span>@endif
                            </td>
                            <td class="px-4 py-3 text-right text-sm sm:px-6">
                                <a href="{{ route('admin-dashboard.services.edit', $service) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                                <form action="{{ route('admin-dashboard.services.destroy', $service) }}" method="post" class="inline" onsubmit="return confirm('Delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500 sm:px-6">No services yet. <a href="{{ route('admin-dashboard.services.create') }}" class="text-admin-teal hover:underline">Add one</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
