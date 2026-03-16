@extends('admin-dashboard.layouts.app')
@section('title', 'Add Training Program')
@section('header', 'Add Training Program')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin-dashboard.training.store') }}" method="post" class="space-y-5">
            @csrf
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Title *</label><input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">@error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Description</label><textarea name="description" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">{{ old('description') }}</textarea></div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Duration</label><input type="text" name="duration" value="{{ old('duration') }}" placeholder="e.g. 2 years" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Slug</label><input type="text" name="slug" value="{{ old('slug') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div>
            <div class="flex gap-4"><div><label class="block text-sm font-medium text-admin-dark mb-1">Sort order</label><input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-lg border border-gray-300 px-4 py-2"></div><div class="flex items-end pb-2"><label class="flex items-center gap-2"><input type="checkbox" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }} class="rounded text-admin-teal"> Visible</label></div></div>
            <div class="flex gap-3"><a href="{{ route('admin-dashboard.training.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-admin-dark hover:bg-admin-bg">Cancel</a><button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button></div>
        </form>
    </div>
@endsection
