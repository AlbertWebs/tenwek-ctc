@extends('admin-dashboard.layouts.app')

@section('title', 'Edit team member')
@section('header', 'Edit team member')

@section('content')
    <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin-dashboard.team-members.update', $member) }}" method="post" enctype="multipart/form-data" class="space-y-5"
              x-data="{ previewUrl: null }">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $member->name) }}" required
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $member->title) }}" required
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $member->specialization) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
            </div>
            <x-admin.trix-field name="bio" id="bio" label="Bio" :value="$member->bio" minHeight="12rem" />
            <div class="space-y-3">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal bg-white"
                               @change="previewUrl = $event.target.files?.[0] ? URL.createObjectURL($event.target.files[0]) : null">
                        <p class="mt-1 text-xs text-gray-500">Upload an image (max 5MB).</p>
                    </div>
                    <div class="pt-7">
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="remove_photo" value="1" class="rounded border-gray-300 text-admin-teal focus:ring-admin-teal">
                            Remove photo
                        </label>
                    </div>
                </div>

                <div>
                    <label for="photo_url" class="block text-sm font-medium text-gray-700 mb-1">Or paste photo URL (optional)</label>
                    <input type="text" name="photo_url" id="photo_url" value="{{ old('photo_url') }}" placeholder="https://..."
                           class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                </div>

                @if($member->photo_url)
                    <div class="rounded-xl overflow-hidden border border-gray-200 bg-gray-50">
                        <div class="aspect-[4/3]">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="h-full w-full object-cover" loading="lazy">
                        </div>
                        <div class="px-4 py-3 border-t border-gray-200 text-xs text-gray-500 truncate">
                            Current: {{ $member->photo }}
                        </div>
                    </div>
                @endif

                <div x-show="previewUrl" x-cloak class="rounded-xl overflow-hidden border border-gray-200 bg-gray-50">
                    <div class="aspect-[4/3]">
                        <img :src="previewUrl" alt="Preview" class="h-full w-full object-cover">
                    </div>
                    <div class="px-4 py-3 border-t border-gray-200 text-xs text-gray-500">
                        New photo preview (not saved yet)
                    </div>
                </div>
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $member->slug) }}" placeholder="unique-profile-slug"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $member->sort_order) }}" min="0"
                           class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                </div>
                <div class="flex items-center pt-8">
                    <input type="checkbox" name="is_visible" id="is_visible" value="1" {{ old('is_visible', $member->is_visible) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-ctc-blue focus:ring-ctc-blue">
                    <label for="is_visible" class="ml-2 text-sm text-gray-700">Visible on site</label>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin-dashboard.team-members.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Update</button>
            </div>
        </form>
    </div>
@endsection
