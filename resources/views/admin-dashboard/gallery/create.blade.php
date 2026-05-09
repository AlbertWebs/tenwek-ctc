@extends('admin-dashboard.layouts.app')

@section('title', 'Add gallery image')
@section('header', 'Add gallery image')

@section('content')
    <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-6 max-w-3xl">
        <form action="{{ route('admin-dashboard.gallery.store') }}" method="post" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <x-admin.trix-field
                name="caption"
                id="caption"
                label="Caption"
                minHeight="8rem"
            />

            <div>
                <span class="block text-sm font-medium text-gray-700 mb-2">Image *</span>
                <p class="text-xs text-gray-500 mb-3">Drag and drop a file here, or click to browse. You can use a URL instead below.</p>

                <div
                    class="rounded-xl border-2 border-dashed transition-colors"
                    x-data="{
                        dragging: false,
                        previewUrl: null,
                        fileName: '',
                        pick(files) {
                            const f = files && files[0];
                            if (!f || !f.type.startsWith('image/')) return;
                            if (this.previewUrl) URL.revokeObjectURL(this.previewUrl);
                            this.previewUrl = URL.createObjectURL(f);
                            this.fileName = f.name;
                            const dt = new DataTransfer();
                            dt.items.add(f);
                            this.$refs.fileInput.files = dt.files;
                            document.getElementById('image_url').value = '';
                        },
                        clearFile() {
                            if (this.previewUrl) URL.revokeObjectURL(this.previewUrl);
                            this.previewUrl = null;
                            this.fileName = '';
                            this.$refs.fileInput.value = '';
                        }
                    }"
                    :class="dragging ? 'border-admin-teal bg-admin-teal/5' : 'border-gray-300 bg-gray-50/50'"
                >
                    <input type="file" name="image" x-ref="fileInput" accept="image/jpeg,image/png,image/webp,image/gif" class="sr-only"
                           @change="pick($event.target.files)">

                    <div role="button" tabindex="0"
                         @click="$refs.fileInput.click()"
                         @keydown.enter.prevent="$refs.fileInput.click()"
                         @keydown.space.prevent="$refs.fileInput.click()"
                         @dragover.prevent="dragging = true"
                         @dragleave.prevent="dragging = false"
                         @drop.prevent="dragging = false; pick($event.dataTransfer.files)"
                         class="w-full cursor-pointer px-6 py-10 rounded-xl focus:outline-none focus:ring-2 focus:ring-admin-teal focus:ring-inset">
                        <div class="flex flex-col items-center text-center gap-3 pointer-events-none">
                            <span class="flex h-12 w-12 items-center justify-center rounded-full bg-admin-teal/15 text-admin-teal">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                            </span>
                            <div>
                                <span class="text-sm font-semibold text-gray-900">Drop image here or click to upload</span>
                                <p class="mt-1 text-xs text-gray-500">JPEG, PNG, WebP or GIF · max 5&nbsp;MB</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="fileName" x-cloak class="px-6 pb-6 flex flex-col items-center gap-2 border-t border-gray-200/80 pt-4">
                        <p class="text-xs font-medium text-admin-teal truncate max-w-full text-center" x-text="fileName"></p>
                        <img x-bind:src="previewUrl" alt="" class="max-h-40 rounded-lg border border-gray-200 object-contain bg-white">
                        <button type="button" @click="clearFile()" class="text-xs text-red-600 hover:underline">Remove file</button>
                    </div>
                </div>
                @error('image')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="relative">
                <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">Or paste image URL</label>
                <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}"
                       placeholder="https://…"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                <p class="mt-1 text-xs text-gray-500">Optional if you uploaded a file. Cleared when you choose a file.</p>
                @error('image_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-admin-teal focus:border-admin-teal">
                    @error('sort_order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center pt-8">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="rounded border-gray-300 text-admin-teal focus:ring-ctc-blue">
                    <label for="is_published" class="ml-2 text-sm text-gray-700">Published (visible on site)</label>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin-dashboard.gallery.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button>
            </div>
        </form>
    </div>
@endsection
