@extends('admin-dashboard.layouts.app')

@section('title', 'Add article')
@section('header', 'Add article')

@section('content')
    <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-6 max-w-3xl">
        <form action="{{ route('admin-dashboard.news.store') }}" method="post" class="space-y-5">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                    <select name="type" id="type" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                        <option value="news" {{ old('type', 'news') === 'news' ? 'selected' : '' }}>News</option>
                        <option value="event" {{ old('type') === 'event' ? 'selected' : '' }}>Event</option>
                        <option value="announcement" {{ old('type') === 'announcement' ? 'selected' : '' }}>Announcement</option>
                    </select>
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug (optional)</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal" placeholder="Auto-generated if empty">
                </div>
            </div>
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                <textarea name="excerpt" id="excerpt" rows="2" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">{{ old('excerpt') }}</textarea>
            </div>
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Body</label>
                <textarea name="body" id="body" rows="8" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">{{ old('body') }}</textarea>
            </div>
            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Featured image URL</label>
                <input type="text" name="featured_image" id="featured_image" value="{{ old('featured_image') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Publish date</label>
                    <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                </div>
                <div class="flex items-center pt-8">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="rounded border-gray-300 text-admin-teal focus:ring-ctc-blue">
                    <label for="is_published" class="ml-2 text-sm text-gray-700">Published</label>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin-dashboard.news.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button>
            </div>
        </form>
    </div>
@endsection
