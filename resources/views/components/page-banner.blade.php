@props([
    'title',
    'subtitle' => null,
])

@php
    $imageUrl = config('ctc.page_banner_image');
@endphp

<section class="relative bg-ctc-blue text-white overflow-hidden min-h-[42vh] flex items-center">
    @if($imageUrl)
        <div class="absolute inset-0 w-full h-full" aria-hidden="true">
            <img
                src="{{ $imageUrl }}"
                alt=""
                class="absolute inset-0 w-full h-full object-cover"
                loading="eager"
                fetchpriority="high"
            />
        </div>
    @endif
    {{-- Gradient overlay: secondary color for strong, readable title --}}
    <div
        class="absolute inset-0 bg-gradient-to-br from-ctc-secondary/90 via-ctc-secondary/75 to-ctc-blue/90"
        aria-hidden="true"
    ></div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative z-10">
        <div class="max-w-4xl">
            <h1 class="font-headline text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-[1.05] tracking-tight text-white drop-shadow-md">
                {{ $title }}
            </h1>
            @if($subtitle)
                <p class="mt-4 font-headline text-[0.7rem] sm:text-[0.75rem] font-bold uppercase tracking-[0.22em] text-white/80 drop-shadow-sm">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
    </div>
</section>
