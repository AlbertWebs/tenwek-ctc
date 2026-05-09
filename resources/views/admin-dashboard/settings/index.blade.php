@extends('admin-dashboard.layouts.app')

@section('title', 'Settings')
@section('header', 'Settings')

@section('content')
    <div class="max-w-6xl space-y-6">
        <div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm p-6">
            <h2 class="text-lg font-semibold text-admin-dark mb-1">System settings</h2>
            <p class="text-sm text-admin-muted">Shortcuts to the configuration areas for the public site and admin security.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach($sections as $section)
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-200 bg-admin-bg/40">
                        <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-admin-muted">{{ $section['title'] }}</p>
                    </div>
                    <div class="p-3">
                        <div class="space-y-1">
                            @foreach($section['items'] as $item)
                                @php
                                    $perm = $item['permission'] ?? null;
                                    $can = !$perm || auth()->user()->hasPermission($perm);
                                    $href = $can ? route($item['route']) . (!empty($item['hash']) ? ('#' . ltrim($item['hash'], '#')) : '') : null;
                                @endphp
                                @if($can)
                                    <a href="{{ $href }}"
                                       class="flex items-center justify-between gap-3 rounded-lg px-3 py-2.5 hover:bg-admin-bg transition-colors">
                                        <span class="text-sm font-medium text-admin-dark">{{ $item['label'] }}</span>
                                        <svg class="w-4 h-4 text-admin-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

