@extends('admin-dashboard.layouts.app')

@section('title', 'College website')
@section('header', 'College website')

@section('content')
    @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

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
            <h2 class="text-lg font-semibold text-admin-dark mb-1">College website link</h2>
            <p class="text-sm text-admin-muted">
                Shown on the public <strong>Training &amp; Research</strong> page as a call-to-action. Leave the URL blank to hide the external link (page copy still mentions the college where relevant).
            </p>

            <form method="post" action="{{ route('admin-dashboard.settings.college-website.update') }}" class="mt-6 space-y-4 max-w-2xl">
                @csrf
                @method('PUT')

                <div>
                    <label for="college_url" class="block text-sm font-semibold text-admin-dark">Website URL</label>
                    <input id="college_url" name="url" type="url" value="{{ old('url', $url) }}"
                           placeholder="https://"
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                </div>

                <div>
                    <label for="college_label" class="block text-sm font-semibold text-admin-dark">Link label</label>
                    <input id="college_label" name="label" type="text" value="{{ old('label', $label) }}"
                           placeholder="{{ config('ctc.college_website.label') }}"
                           class="mt-1.5 block w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-admin-dark focus:border-admin-teal focus:ring-admin-teal"/>
                    <p class="mt-1.5 text-xs text-admin-muted">Button text on the public page (e.g. “Visit Tenwek College”). If empty, the label from config / <code class="text-xs">CTC_COLLEGE_WEBSITE_LABEL</code> is used.</p>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-admin-teal text-white text-sm font-medium hover:bg-admin-teal-dark transition-colors">
                        Save
                    </button>
                    <a href="{{ route('admin-dashboard.settings.index') }}" class="text-sm text-admin-teal hover:underline">Back to settings</a>
                </div>
            </form>
        </div>
    </div>
@endsection
