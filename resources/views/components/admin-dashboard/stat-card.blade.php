@props(['label', 'value', 'href' => null, 'icon' => 'chart', 'color' => 'teal'])
@php
    $colors = [
        'teal' => 'bg-admin-teal text-white',
        'coral' => 'bg-admin-coral text-white',
        'gold' => 'bg-admin-gold text-admin-dark',
        'dark' => 'bg-admin-dark text-white',
    ];
    $bg = $colors[$color] ?? $colors['teal'];
@endphp
<div class="rounded-xl border border-gray-200 bg-admin-surface shadow-sm overflow-hidden hover:shadow-md transition-shadow">
    <div class="p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-admin-muted">{{ $label }}</p>
                <p class="mt-1 text-2xl font-bold text-admin-dark">{{ $value }}</p>
                @if($href)
                    <a href="{{ $href }}" class="mt-2 inline-block text-sm font-medium text-admin-teal hover:text-admin-teal-dark">View →</a>
                @endif
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $bg }}">
                @include('admin-dashboard.components.icon', ['name' => $icon])
            </div>
        </div>
    </div>
</div>
