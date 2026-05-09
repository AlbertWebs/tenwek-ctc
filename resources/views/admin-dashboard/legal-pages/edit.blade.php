@extends('admin-dashboard.layouts.app')

@section('title', 'Edit: '.$meta['label'])
@section('header', $meta['label'])

@section('content')
    <div class="max-w-4xl space-y-6">
        @if(session('success'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-admin-muted">
                This content appears on
                <a href="{{ route($meta['public_route']) }}" target="_blank" rel="noopener" class="text-admin-teal font-medium hover:underline">{{ $meta['public_path'] }}</a>.
            </p>
        </div>

        <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-6">
            <form action="{{ route('admin-dashboard.legal-pages.update', $page) }}" method="post" class="space-y-6">
                @csrf
                @method('PUT')

                <x-admin.trix-field
                    name="body"
                    label="Page content"
                    :value="$body"
                    help="Use headings for sections, lists where helpful, and bold for emphasis. Links open in a new tab on the public site."
                    minHeight="22rem"
                />

                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="{{ route('admin-dashboard.legal-pages.index') }}"
                       class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">Back</a>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-admin-teal text-white font-medium hover:bg-admin-teal-dark">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
