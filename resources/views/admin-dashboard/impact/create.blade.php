@extends('admin-dashboard.layouts.app')
@section('title', 'Add Impact Story')
@section('header', 'Add Impact Story')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin-dashboard.impact.store') }}" method="post" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Title *</label><input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">@error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror</div>
            <x-admin.trix-field name="story" label="Story" minHeight="12rem" />
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Featured image (upload)</label><input type="file" name="featured_image" accept="image/*" class="w-full text-sm">@error('featured_image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Image URL (optional)</label><input type="text" name="image" value="{{ old('image') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div>
            <div><label class="block text-sm font-medium text-admin-dark mb-1">Media URL (optional)</label><input type="text" name="media_url" value="{{ old('media_url') }}" placeholder="https://youtube.com/..." class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">@error('media_url')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror</div>
            <div class="rounded-lg border border-amber-200 bg-amber-50/80 p-4">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="mt-1 rounded text-admin-teal">
                    <span>
                        <span class="block text-sm font-semibold text-admin-dark">Featured success story</span>
                        <span class="block text-xs text-admin-muted mt-1">Only one story should be featured. It appears prominently on the public Impact page with testimonials.</span>
                    </span>
                </label>
            </div>
            <div class="flex gap-4"><div><label class="block text-sm font-medium text-admin-dark mb-1">Story date</label><input type="date" name="story_date" value="{{ old('story_date') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal"></div><div><label class="block text-sm font-medium text-admin-dark mb-1">Sort order</label><input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-lg border border-gray-300 px-4 py-2"></div><div class="flex items-end pb-2"><label class="flex items-center gap-2"><input type="checkbox" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }} class="rounded text-admin-teal"> Visible</label></div></div>
            <div class="flex gap-3"><a href="{{ route('admin-dashboard.impact.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-admin-dark hover:bg-admin-bg">Cancel</a><button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button></div>
        </form>
    </div>
@endsection
