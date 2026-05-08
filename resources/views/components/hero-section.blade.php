@props([
    'title',
    'subtitle' => null,
    'description' => null,
    'buttons' => [],
    'mode' => 'video', // 'video' | 'carousel'
    'video' => null,
    'slides' => [],
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
@endphp

<style>
@keyframes hero-text-fade {
    from { opacity: 1; }
    to { opacity: 0.4; }
}
.hero-text-fade-after-10s {
    animation: hero-text-fade 1s ease-out 10s forwards;
}
</style>

<section class="relative bg-ctc-blue text-white overflow-hidden h-screen min-h-[100vh] flex items-center justify-center">
    @if($useCarousel)
        <div class="absolute inset-0 w-full h-full overflow-hidden" aria-hidden="true">
            @if($slides->count() > 0)
                @foreach($slides->values() as $index => $slide)
                    <div
                        class="ctc-hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                        style="background-image:url('{{ $slide->image_url ?? '' }}')"
                        data-slide-index="{{ $index }}"
                    ></div>
                @endforeach
            @else
                <div
                    class="absolute inset-0 bg-cover bg-center"
                    style="background-image:url('{{ $carouselFallbackImage }}')"
                ></div>
            @endif
        </div>
    @else
        @if($youtubeId)
            <div class="absolute inset-0 w-full h-full overflow-hidden" aria-hidden="true">
                <iframe
                    src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&loop=1&playlist={{ $youtubeId }}&controls=0&rel=0&showinfo=0&playsinline=1&modestbranding=1&disablekb=1&fs=0&iv_load_policy=3"
                    title=""
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    class="absolute left-1/2 top-1/2 min-w-[177.78vh] min-h-[100vh] w-[100vw] h-[56.25vw] -translate-x-1/2 -translate-y-1/2 pointer-events-none object-cover"
                    style="width: 100vw; height: 56.25vw; min-width: 177.78vh; min-height: 100vh;"
                ></iframe>
            </div>
        @elseif($videoUrl)
            <video
                autoplay
                muted
                loop
                playsinline
                preload="auto"
                class="absolute inset-0 w-full h-full object-cover min-w-full min-h-full"
                aria-hidden="true"
            >
                <source src="{{ $videoUrl }}" type="video/mp4">
            </video>
        @endif
    @endif
    <div class="absolute inset-0 bg-black/50" aria-hidden="true"></div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex justify-center">
        <div class="relative max-w-3xl w-full px-6 sm:px-10 py-10 sm:py-12">
            <div class="absolute inset-0 bg-black/50 rounded-2xl" aria-hidden="true"></div>
            <div class="relative z-10 text-center hero-text-fade-after-10s p-3">
                <h1 id="ctc-hero-title" class="font-headline font-extrabold text-white tracking-[-0.035em] leading-[1.05] mb-5" style="font-size:clamp(2.4rem,5vw,4rem);">
                    {{ $title }}
                </h1>
            @if($subtitle)
                <p id="ctc-hero-subtitle" class="font-headline text-[0.65rem] font-bold uppercase tracking-[0.22em] text-white/80 mb-5">{{ $subtitle }}</p>
            @endif
            @if($description)
                <p id="ctc-hero-description" class="font-sans text-white/75 font-light max-w-lg mx-auto mb-9 text-[0.95rem] leading-[1.75]">{{ $description }}</p>
            @endif
            @if(count($buttons) > 0)
                <div id="ctc-hero-ctas" class="flex flex-wrap gap-4 justify-center">
                    @foreach($buttons as $btn)
                        <a href="{{ $btn['url'] ?? '#' }}" data-cta="1"
                           class="inline-flex items-center gap-2 font-headline font-bold uppercase rounded-lg px-8 py-3.5 text-[0.63rem] tracking-[0.18em] transition-all
                                  {{ ($btn['primary'] ?? true) ? 'bg-white text-ctc-blue hover:bg-gray-100 shadow-md' : 'bg-white/10 text-white border border-white/20 hover:bg-white/18' }}">
                            {{ $btn['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif
            </div>
        </div>
    </div>

    @if($useCarousel && $slides->count() > 0)
        @php
            $slidesPayload = $slides->values()->map(function ($slide) {
                return [
                    'title' => $slide->title,
                    'subtitle' => $slide->subtitle,
                    'cta_label' => $slide->cta_label,
                    'cta_url' => $slide->cta_url,
                ];
            })->values();
        @endphp
        <script>
            (() => {
                const slides = @json($slidesPayload);
                if (!slides.length) return;

                const bgSlides = Array.from(document.querySelectorAll('.ctc-hero-slide'));
                const title = document.getElementById('ctc-hero-title');
                const subtitle = document.getElementById('ctc-hero-subtitle');
                const description = document.getElementById('ctc-hero-description');
                const ctas = Array.from(document.querySelectorAll('#ctc-hero-ctas [data-cta="1"]'));

                let index = 0;
                const initialTitle = title?.innerHTML ?? '';
                const initialSubtitle = subtitle?.textContent ?? '';
                const initialDescription = description?.textContent ?? '';

                const apply = () => {
                    bgSlides.forEach((node, idx) => {
                        node.classList.toggle('opacity-100', idx === index);
                        node.classList.toggle('opacity-0', idx !== index);
                    });

                    const s = slides[index] || {};
                    if (title && s.title) title.textContent = s.title;
                    if (title && !s.title) title.innerHTML = initialTitle;
                    if (subtitle) subtitle.textContent = s.subtitle || initialSubtitle;
                    if (description) description.textContent = initialDescription;

                    // Optional: override first CTA with slide CTA if present
                    if (ctas.length && s.cta_url && s.cta_label) {
                        ctas[0].href = s.cta_url;
                        ctas[0].textContent = s.cta_label;
                    }
                };

                apply();
                window.setInterval(() => {
                    index = (index + 1) % slides.length;
                    apply();
                }, 5000);
            })();
        </script>
    @endif
</section>
