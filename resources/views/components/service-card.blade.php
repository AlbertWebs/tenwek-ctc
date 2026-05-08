@props([
    'name',
    'description' => null,
    'url' => null,
    'detailUrl' => null,
    'id' => null,
])

@php
    $url = $url ?? '#';
    $detailUrl = $detailUrl ?? null;
@endphp

<div
   @if($id) id="{{ $id }}" @endif
   class="group flex flex-col h-full min-h-[190px] p-6 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md hover:border-ctc-blue/30 transition-all duration-200 scroll-mt-24">
    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-ctc-blue transition-colors">{{ $name }}</h3>
    @if($description)
        <p class="mt-2 text-gray-600 text-sm leading-relaxed flex-1">{{ $description }}</p>
    @endif

    <div class="mt-auto pt-5 flex flex-wrap items-center gap-3">
        @if($detailUrl)
            <a href="{{ $detailUrl }}"
               class="inline-flex items-center gap-2 rounded-lg bg-ctc-blue px-4 py-2 text-[11px] font-bold uppercase tracking-[0.18em] text-white hover:bg-ctc-blue-dark transition-colors">
                Learn more
                <svg class="w-4 h-4 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        @endif

        @if($url && $url !== '#')
            <a href="{{ $url }}"
               class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.18em] text-ctc-blue/80 hover:text-ctc-blue transition-colors">
                Explore
                <svg class="w-4 h-4 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        @endif
    </div>
</div>
