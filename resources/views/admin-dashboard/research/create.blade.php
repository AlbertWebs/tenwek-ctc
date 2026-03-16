@extends('admin-dashboard.layouts.app')
@section('title', 'Add Publication')
@section('header', 'Add Research Publication')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin-dashboard.research.store') }}" method="post" class="space-y-5">
            @csrf
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Title *</label><input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">@error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Authors</label><input type="text" name="authors" value="{{ old('authors') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div>
            <div class="grid grid-cols-2 gap-4"><div><label class="block text-sm font-medium text-admin-dark mb-1">Journal</label><input type="text" name="journal" value="{{ old('journal') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div><div><label class="block text-sm font-medium text-admin-dark mb-1">Year</label><input type="text" name="year" value="{{ old('year') }}" maxlength="4" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div></div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">URL</label><input type="url" name="url" value="{{ old('url') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Abstract</label><textarea name="abstract" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">{{ old('abstract') }}</textarea></div>
            <div class="flex gap-4"><div><label class="block text-sm font-medium text-admin-dark mb-1">Sort order</label><input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-lg border border-gray-300 px-4 py-2"></div><div class="flex items-end pb-2"><label class="flex items-center gap-2"><input type="checkbox" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }} class="rounded text-admin-teal"> Visible</label></div></div>
            <div class="flex gap-3"><a href="{{ route('admin-dashboard.research.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-admin-dark hover:bg-admin-bg">Cancel</a><button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button></div>
        </form>
    </div>
@endsection
