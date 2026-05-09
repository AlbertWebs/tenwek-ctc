@extends('admin-dashboard.layouts.app')
@section('title', 'Impact testimonials')
@section('header', 'Impact page: Testimonials')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center sm:px-6">
            <div>
                <p class="text-sm text-admin-muted">{{ $testimonials->count() }} testimonial(s)</p>
                <p class="text-xs text-admin-muted mt-1">Shown in the testimonials carousel on the public <a href="{{ route('impact') }}" class="text-admin-teal hover:underline" target="_blank" rel="noopener">Impact</a> page.</p>
            </div>
            <a href="{{ route('admin-dashboard.impact-testimonials.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-admin-teal text-white hover:bg-admin-teal-dark text-sm">Add testimonial</a>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table min-w-full">
                <thead><tr>
                    <th class="text-left">Quote</th>
                    <th class="text-left">Author</th>
                    <th class="text-left">Visible</th>
                    <th class="text-right">Actions</th>
                </tr></thead>
                <tbody class="bg-white">
                    @forelse($testimonials as $t)
                        <tr class="hover:bg-admin-bg/50">
                            <td class="text-sm text-admin-dark max-w-md">{{ \Illuminate\Support\Str::limit(strip_tags($t->quote), 80) }}</td>
                            <td class="text-sm text-admin-muted">{{ $t->author_name }}@if($t->author_role)<span class="text-admin-muted">, {{ $t->author_role }}</span>@endif</td>
                            <td class="text-sm">{{ $t->is_visible ? 'Yes' : 'No' }}</td>
                            <td class="text-right text-sm">
                                <a href="{{ route('admin-dashboard.impact-testimonials.edit', $t) }}" class="text-admin-teal hover:underline mr-3">Edit</a>
                                <form action="{{ route('admin-dashboard.impact-testimonials.destroy', $t) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-admin-coral hover:underline">Delete</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-admin-muted py-10">No testimonials. <a href="{{ route('admin-dashboard.impact-testimonials.create') }}" class="text-admin-teal hover:underline">Add one</a>.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
