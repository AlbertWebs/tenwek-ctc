@extends('admin-dashboard.layouts.app')

@section('title', 'Add team member')
@section('header', 'Add team member')

@section('content')
    <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin-dashboard.team-members.store') }}" method="post" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                <input type="text" name="specialization" id="specialization" value="{{ old('specialization') }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
            </div>
            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                <textarea name="bio" id="bio" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">{{ old('bio') }}</textarea>
            </div>
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Photo URL</label>
                <input type="text" name="photo" id="photo" value="{{ old('photo') }}" placeholder="https://..."
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                </div>
                <div class="flex items-center pt-8">
                    <input type="checkbox" name="is_visible" id="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-admin-teal focus:ring-ctc-blue">
                    <label for="is_visible" class="ml-2 text-sm text-gray-700">Visible on site</label>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin-dashboard.team-members.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button>
            </div>
        </form>
    </div>
@endsection
