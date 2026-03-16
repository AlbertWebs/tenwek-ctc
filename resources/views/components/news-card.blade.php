@props([
    'title',
    'excerpt' => null,
    'type' => 'news',
    'date' => null,
    'url' => null,
])

@php
    $tag = $url ? 'a' : 'article';
    $url = $url ?? '#';
@endphp

<{{ $tag }} href="{{ $url }}"
   class="block rounded-xl bg-white border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all group">
    <div class="p-5">
        @if($type)
            <span class="inline-block text-xs font-medium uppercase tracking-wide text-ctc-accent mb-2">{{ $type }}</span>
        @endif
        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-ctc-blue transition-colors">{{ $title }}</h3>
        @if($date)
            <p class="text-sm text-gray-500 mt-1">{{ $date?->format('F j, Y') ?? $date }}</p>
        @endif
        @if($excerpt)
            <p class="mt-2 text-gray-600 text-sm leading-relaxed line-clamp-2">{{ $excerpt }}</p>
        @endif
    </div>
</{{ $tag }}>
