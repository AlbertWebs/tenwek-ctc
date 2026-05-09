@extends('admin-dashboard.layouts.app')

@section('title', 'Social links')
@section('header', 'Social links')

@section('content')
    @if($errors->any())
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800 shadow-sm">
            <p class="font-medium">Please fix the following:</p>
            <ul class="mt-2 list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-4xl space-y-6">
        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h2 class="text-lg font-semibold text-admin-dark mb-1">Footer social links</h2>
            <p class="text-sm text-admin-muted">Paste full URLs. Leave blank to hide an icon in the footer.</p>

            <form method="post" action="{{ route('admin-dashboard.settings.social-links.update') }}" class="mt-6 space-y-4 max-w-2xl">
                @csrf
                @method('PUT')

                <div>
                    <label for="facebook" class="block text-sm font-semibold text-admin-dark">Facebook</label>
                    <input id="facebook" name="facebook" type="url" value="{{ old('facebook', $facebook) }}"
                           placeholder="https://facebook.com/..."
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div>
                    <label for="linkedin" class="block text-sm font-semibold text-admin-dark">LinkedIn</label>
                    <input id="linkedin" name="linkedin" type="url" value="{{ old('linkedin', $linkedin) }}"
                           placeholder="https://linkedin.com/company/..."
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div>
                    <label for="instagram" class="block text-sm font-semibold text-admin-dark">Instagram</label>
                    <input id="instagram" name="instagram" type="url" value="{{ old('instagram', $instagram) }}"
                           placeholder="https://instagram.com/..."
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div>
                    <label for="youtube" class="block text-sm font-semibold text-admin-dark">YouTube</label>
                    <input id="youtube" name="youtube" type="url" value="{{ old('youtube', $youtube) }}"
                           placeholder="https://youtube.com/@..."
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div>
                    <label for="x" class="block text-sm font-semibold text-admin-dark">X</label>
                    <input id="x" name="x" type="url" value="{{ old('x', $x) }}"
                           placeholder="https://x.com/..."
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">
                        Save social links
                    </button>
                    <a href="{{ route('admin-dashboard.settings.index') }}" class="text-sm text-admin-teal hover:underline">Back to settings</a>
                </div>
            </form>
        </div>
    </div>
@endsection

