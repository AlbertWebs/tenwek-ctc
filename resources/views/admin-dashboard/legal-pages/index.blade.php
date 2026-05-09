@extends('admin-dashboard.layouts.app')

@section('title', 'Legal pages')
@section('header', 'Legal pages')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-6">
            <p class="text-sm text-admin-muted">
                Edit Privacy Policy and Terms of Service shown on the public site. Use headings and lists for clear structure.
            </p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($pages as $p)
                <a href="{{ route('admin-dashboard.legal-pages.edit', $p['slug']) }}"
                   class="block rounded-xl bg-white border border-gray-200 shadow-sm p-6 hover:border-admin-teal/40 hover:shadow-md transition-all">
                    <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-admin-muted">Legal</p>
                    <h2 class="mt-2 text-lg font-semibold text-admin-dark">{{ $p['label'] }}</h2>
                    <p class="mt-2 text-sm text-admin-muted">Public: {{ $p['public_path'] }}</p>
                    <span class="mt-4 inline-flex text-sm font-medium text-admin-teal">Edit →</span>
                </a>
            @endforeach
        </div>
    </div>
@endsection
