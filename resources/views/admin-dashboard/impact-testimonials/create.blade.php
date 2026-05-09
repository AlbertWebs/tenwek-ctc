@extends('admin-dashboard.layouts.app')
@section('title', 'Add testimonial')
@section('header', 'Add Impact testimonial')
@section('content')
    <div class="rounded-xl bg-admin-surface border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin-dashboard.impact-testimonials.store') }}" method="post" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-admin-dark mb-1">Quote *</label>
                <textarea name="quote" rows="5" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">{{ old('quote') }}</textarea>
                @error('quote')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-admin-dark mb-1">Author name *</label>
                <input type="text" name="author_name" value="{{ old('author_name') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">
                @error('author_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-admin-dark mb-1">Role / context (optional)</label>
                <input type="text" name="author_role" value="{{ old('author_role') }}" placeholder="e.g. Patient, Parent, Referring clinician" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal">
                @error('author_role')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-admin-dark mb-1">Photo (optional)</label>
                <input type="file" name="photo" accept="image/*" class="w-full text-sm">
                @error('photo')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-4">
                <div>
                    <label class="block text-sm font-medium text-admin-dark mb-1">Sort order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }} class="rounded text-admin-teal"> Visible
                    </label>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin-dashboard.impact-testimonials.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-admin-dark hover:bg-admin-bg">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button>
            </div>
        </form>
    </div>
@endsection
