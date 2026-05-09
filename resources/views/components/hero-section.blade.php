@props([
    'title',
    'subtitle' => null,
    'description' => null,
    'buttons' => [],
    'mode' => 'video', // 'video' | 'carousel'
    'video' => null,
    'slides' => [],
    'scrollIndicatorTarget' => '#home-stats',
])

@php
    $mode = in_array($mode, ['video', 'carousel'], true) ? $mode : 'video';
    $slides = $slides instanceof \Illuminate\Support\Collection ? $slides : collect($slides);
    $useCarousel = $mode === 'carousel';
    $carouselFallbackImage = config('ctc.page_banner_image');

    $videoSource = $video ?? config('ctc.hero_video');
    $isYoutube = $videoSource && (str_contains($videoSource, 'youtube.com/watch') || str_contains($videoSource, 'youtu.be/'));
    $youtubeId = null;
    if ($isYoutube && preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $videoSource, $m)) {
        $youtubeId = $m[1];
    }
    $videoUrl = null;
    if (!$isYoutube && $videoSource) {
        $videoUrl = str_starts_with($videoSource, 'http') ? $videoSource : asset($videoSource);
    }

    $slidesPayload = $slides->values()->map(function ($slide) {
        return [
            'title' => $slide->title,
            'subtitle' => $slide->subtitle,
            'cta_label' => $slide->cta_label,
            'cta_url' => $slide->cta_url,
        ];
    })->values();
@endphp

<section
    class="relative bg-ctc-blue text-white overflow-hidden flex items-center justify-center min-h-[90svh] sm:min-h-[100svh]"
    data-ctc-hero
>
    @if($useCarousel)
        <div class="absolute inset-0 w-full h-full overflow-hidden" data-ctc-hero-media aria-hidden="true">
            @if($slides->count() > 0)
                @foreach($slides->values() as $index => $slide)
                    <div
                        class="ctc-hero-slide absolute inset-0 bg-cover bg-center {{ $index === 0 ? 'opacity-100 z-[1]' : 'opacity-0 z-0' }}"
                        style="background-image:url('{{ $slide->image_url ?? '' }}')"
                        data-slide-index="{{ $index }}"
                    ></div>
                @endforeach
            @else
                <div
                    class="absolute inset-0 bg-cover bg-center scale-105"
                    style="background-image:url('{{ $carouselFallbackImage }}')"
                ></div>
            @endif
        </div>
    @else
        <div class="absolute inset-0 w-full h-full overflow-hidden" data-ctc-hero-media aria-hidden="true">
            @if($youtubeId)
                <iframe
                    src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&loop=1&playlist={{ $youtubeId }}&controls=0&rel=0&showinfo=0&playsinline=1&modestbranding=1&disablekb=1&fs=0&iv_load_policy=3"
                    title=""
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    class="absolute left-1/2 top-1/2 min-w-[177.78vh] min-h-[100vh] w-[100vw] h-[56.25vw] -translate-x-1/2 -translate-y-1/2 pointer-events-none object-cover"
                    style="width: 100vw; height: 56.25vw; min-width: 177.78vh; min-height: 100vh;"
                ></iframe>
            @elseif($videoUrl)
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    preload="metadata"
                    poster="{{ $carouselFallbackImage }}"
                    class="absolute inset-0 w-full h-full object-cover min-w-full min-h-full scale-105"
                >
                    <source src="{{ $videoUrl }}" type="video/mp4">
                </video>
            @endif
        </div>
    @endif

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex justify-center">
        <div class="relative max-w-3xl w-full px-4 sm:px-10 py-6 sm:py-12">
            <div class="absolute inset-0 bg-black/50 rounded-2xl motion-reduce:bg-black/55" aria-hidden="true"></div>
            <div class="relative z-10 text-center p-2 sm:p-3">
                <h1 id="ctc-hero-title" class="font-headline font-extrabold text-white tracking-[-0.035em] leading-[1.03] mb-3 sm:mb-5 drop-shadow-[0_18px_45px_rgba(0,0,0,0.45)]" style="font-size:clamp(1.75rem,5vw,4rem);">
                    {{ $title }}
                </h1>
            @if($subtitle)
                <p id="ctc-hero-subtitle" class="font-headline text-[0.58rem] sm:text-[0.65rem] font-bold uppercase tracking-[0.22em] mb-3 sm:mb-5">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 border border-white/15 shadow-[0_18px_45px_rgba(0,0,0,0.25)]">
                        <span class="h-2 w-2 rounded-full bg-ctc-accent shadow-[0_0_0_4px_rgba(228,195,115,0.20)]"></span>
                        <span class="text-white/90">{{ $subtitle }}</span>
                    </span>
                </p>
            @endif
            @if($description)
                <p id="ctc-hero-description" class="font-sans text-white/80 font-medium max-w-lg mx-auto mb-5 sm:mb-9 text-[0.88rem] sm:text-[0.95rem] leading-[1.55] sm:leading-[1.75] drop-shadow-[0_18px_45px_rgba(0,0,0,0.35)] line-clamp-4 sm:line-clamp-none">{{ $description }}</p>
            @endif
            @if(count($buttons) > 0)
                @php
                    $ctaCount = count($buttons);
                    // When exactly 2 CTAs, keep them side-by-side on all screens.
                    $ctaContainerClass = $ctaCount === 2
                        ? 'mx-auto grid grid-cols-2 gap-3 sm:gap-4 max-w-[34rem]'
                        : 'flex flex-wrap gap-4 justify-center';
                    $ctaItemClass = $ctaCount === 2
                        ? 'w-full justify-center px-3 py-2.5'
                        : 'px-8 py-3.5';
                @endphp
                <div id="ctc-hero-ctas" class="{{ $ctaContainerClass }}">
                    @foreach($buttons as $btn)
                        @php
                            $label = (string) ($btn['label'] ?? '');
                        @endphp
                        <a href="{{ $btn['url'] ?? '#' }}" data-cta="1"
                           class="ctc-magnetic ctc-btn-shine inline-flex items-center gap-2 font-headline font-bold uppercase rounded-lg {{ $ctaItemClass }} text-[0.58rem] sm:text-[0.63rem] tracking-[0.18em] transition-transform duration-300 will-change-transform
                                  {{ ($btn['primary'] ?? true)
                                        ? 'bg-[linear-gradient(135deg,rgba(228,195,115,0.98),rgba(98,163,161,0.92))] text-ctc-blue hover:brightness-105 shadow-[0_18px_45px_rgba(0,0,0,0.35)]'
                                        : 'bg-white/10 text-white border border-white/20 hover:bg-white/18 backdrop-blur-sm shadow-[0_18px_45px_rgba(0,0,0,0.25)]' }}">
                            @if(strtolower($label) === 'book appointment')
                                <span class="sm:hidden">Book</span>
                                <span class="hidden sm:inline">Book appointment</span>
                            @else
                                {{ $label }}
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
            </div>
        </div>
    </div>

    @if($useCarousel && $slides->count() > 0)
        <div class="absolute bottom-10 left-0 right-0 z-20 flex justify-center gap-2 px-4" role="tablist" aria-label="Hero slides">
            @foreach($slides->values() as $index => $slide)
                <button
                    type="button"
                    data-ctc-hero-dot
                    class="ctc-hero-dot h-2.5 w-2.5 rounded-full border border-white/40 bg-white/25 transition-all duration-300 hover:bg-white/50 focus:outline-none focus-visible:ring-2 focus-visible:ring-ctc-accent {{ $index === 0 ? 'ctc-hero-dot--active w-8 bg-white/90 border-white/70' : '' }}"
                    aria-label="Show slide {{ $index + 1 }}"
                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                ></button>
            @endforeach
        </div>
        <script type="application/json" id="ctc-hero-carousel-data">{!! json_encode($slidesPayload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @endif

    @if(!($useCarousel && $slides->count() > 0))
        <button
            type="button"
            class="hidden sm:flex absolute bottom-6 left-1/2 z-20 -translate-x-1/2 cursor-pointer flex-col items-center gap-1 rounded-lg border border-transparent bg-transparent p-1 text-white/70 transition-colors hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-ctc-accent focus-visible:ring-offset-2 focus-visible:ring-offset-ctc-blue/40 motion-reduce:hidden"
            data-ctc-hero-scroll-indicator
            data-ctc-hero-scroll-to="{{ $scrollIndicatorTarget }}"
            aria-label="Scroll to main content"
        >
            <span class="pointer-events-none text-[0.6rem] font-bold uppercase tracking-[0.28em]">Scroll</span>
            <span class="ctc-hero-scroll-indicator__chev pointer-events-none flex h-8 w-5 items-start justify-center rounded-full border border-white/25 pt-1.5">
                <span class="block h-1.5 w-1 rounded-full bg-white/80"></span>
            </span>
        </button>
    @endif
</section>
