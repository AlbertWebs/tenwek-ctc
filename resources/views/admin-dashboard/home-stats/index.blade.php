@extends('admin-dashboard.layouts.app')

@section('title', 'Homepage Stats')
@section('header', 'Homepage Stats')

@section('content')
    <div class="max-w-6xl space-y-8">
        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h2 class="text-lg font-semibold text-admin-dark mb-1">Stats shown on the homepage</h2>
            <p class="text-sm text-admin-muted mb-6">Add, edit, reorder, or hide the stat cards that appear under the hero.</p>

            <form method="post" action="{{ route('admin-dashboard.home-stats.store') }}" class="grid gap-4 md:grid-cols-12 items-end rounded-xl border border-gray-200 p-4">
                @csrf

                <div class="md:col-span-3">
                    <label class="block text-sm font-semibold text-admin-dark">Value</label>
                    <input type="text" name="value" value="{{ old('value') }}" placeholder="5,000+" required
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-admin-teal focus:ring-admin-teal">
                    @error('value')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="md:col-span-5">
                    <label class="block text-sm font-semibold text-admin-dark">Label</label>
                    <input type="text" name="label" value="{{ old('label') }}" placeholder="Surgeries Performed" required
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-admin-teal focus:ring-admin-teal">
                    @error('label')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-admin-dark">Sort order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-admin-teal focus:ring-admin-teal">
                </div>

                <div class="md:col-span-1 flex items-center gap-2 pb-2">
                    <input id="is_visible_new" type="checkbox" name="is_visible" value="1" class="rounded border-gray-300" checked>
                    <label for="is_visible_new" class="text-sm text-admin-dark">Visible</label>
                </div>

                <div class="md:col-span-1">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-3 rounded-xl bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">
                        Add
                    </button>
                </div>
            </form>
        </div>

        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between sm:px-6">
                <p class="text-sm text-admin-muted">{{ $stats->count() }} stat(s)</p>
            </div>

            <div class="divide-y divide-gray-200">
                @forelse($stats as $stat)
                    <div class="p-4 sm:p-6">
                        <form method="post" action="{{ route('admin-dashboard.home-stats.update', $stat) }}" class="grid gap-4 md:grid-cols-12 items-end">
                            @csrf
                            @method('PUT')

                            <div class="md:col-span-3">
                                <label class="block text-sm font-semibold text-admin-dark">Value</label>
                                <input type="text" name="value" value="{{ old('value', $stat->value) }}" required
                                       class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-admin-teal focus:ring-admin-teal">
                            </div>

                            <div class="md:col-span-5">
                                <label class="block text-sm font-semibold text-admin-dark">Label</label>
                                <input type="text" name="label" value="{{ old('label', $stat->label) }}" required
                                       class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-admin-teal focus:ring-admin-teal">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-admin-dark">Sort order</label>
                                <input type="number" name="sort_order" value="{{ old('sort_order', $stat->sort_order) }}" min="0"
                                       class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-admin-teal focus:ring-admin-teal">
                            </div>

                            <div class="md:col-span-1 flex items-center gap-2 pb-2">
                                <input id="is_visible_{{ $stat->id }}" type="checkbox" name="is_visible" value="1" class="rounded border-gray-300" {{ $stat->is_visible ? 'checked' : '' }}>
                                <label for="is_visible_{{ $stat->id }}" class="text-sm text-admin-dark">Visible</label>
                            </div>

                            <div class="md:col-span-1 flex items-center justify-end gap-3">
                                <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">
                                    Save
                                </button>
                            </div>
                        </form>

                        <form method="post" action="{{ route('admin-dashboard.home-stats.destroy', $stat) }}" class="mt-3" onsubmit="return confirm('Delete this stat?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg border border-red-200 bg-red-50 text-red-700 text-sm font-medium hover:bg-red-100 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="p-10 text-center text-sm text-admin-muted">No homepage stats yet.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

