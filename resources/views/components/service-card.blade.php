@props([
    'name',
    'description' => null,
    'url' => null,
])

@php
    $tag = $url ? 'a' : 'div';
    $url = $url ?? '#';
@endphp

<{{ $tag }} href="{{ $url }}"
   class="group flex flex-col h-full min-h-[190px] p-6 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md hover:border-ctc-blue/30 transition-all duration-200">
    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-ctc-blue transition-colors">{{ $name }}</h3>
    @if($description)
        <p class="mt-2 text-gray-600 text-sm leading-relaxed flex-1">{{ $description }}</p>
    @endif

    <div class="mt-auto pt-5 inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.18em] text-ctc-blue/80 group-hover:text-ctc-blue transition-colors">
        <span>{{ $url && $url !== '#' ? 'Explore' : 'Learn more' }}</span>
        <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>
    </div>
</{{ $tag }}>
