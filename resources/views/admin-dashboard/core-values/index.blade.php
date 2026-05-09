@extends('admin-dashboard.layouts.app')
@section('title', 'Core Values')
@section('header', 'Core Values (What guides our care)')

@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center sm:px-6">
            <p class="text-sm text-admin-muted">{{ $values->count() }} value(s)</p>
            <a href="{{ route('admin-dashboard.core-values.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">
                Add value
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table min-w-full">
                <thead>
                <tr>
                    <th class="text-left">Title</th>
                    <th class="text-left">Visible</th>
                    <th class="text-left">Order</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @forelse($values as $v)
                    <tr class="hover:bg-admin-bg/50">
                        <td class="text-sm font-medium text-admin-dark">
                            {{ $v->title }}
                            @if($v->description)
                                <p class="mt-1 text-xs text-admin-muted max-w-[44rem]">{{ str($v->description)->stripTags()->limit(160) }}</p>
                            @endif
                        </td>
                        <td class="text-sm">{{ $v->is_visible ? 'Yes' : 'No' }}</td>
                        <td class="text-sm text-admin-muted">{{ $v->sort_order }}</td>
                        <td class="text-right text-sm">
                            <a href="{{ route('admin-dashboard.core-values.edit', $v) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin-dashboard.core-values.destroy', $v) }}" method="post" class="inline"
                                  onsubmit="return confirm('Delete this value?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-admin-coral hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-admin-muted py-10">
                            No values yet.
                            <a href="{{ route('admin-dashboard.core-values.create') }}" class="text-admin-teal hover:underline">Add one</a>.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

