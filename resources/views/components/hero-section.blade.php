@props([
    'title',
    'subtitle' => null,
    'description' => null,
    'buttons' => [],
    'video' => null,
])

@php
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
    <div class="absolute inset-0 bg-black/50" aria-hidden="true"></div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex justify-center">
        <div class="relative max-w-3xl w-full px-6 sm:px-10 py-10 sm:py-12">
            <div class="absolute inset-0 bg-black/50 rounded-2xl" aria-hidden="true"></div>
            <div class="relative z-10 text-center hero-text-fade-after-10s p-3">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-4">{{ $title }}</h1>
            @if($subtitle)
                <p class="text-xl text-blue-100 mb-6">{{ $subtitle }}</p>
            @endif
            @if($description)
                <p class="text-lg text-blue-100/90 leading-relaxed mb-8">{{ $description }}</p>
            @endif
            @if(count($buttons) > 0)
                <div class="flex flex-wrap gap-4 justify-center">
                    @foreach($buttons as $btn)
                        <a href="{{ $btn['url'] ?? '#' }}"
                           class="inline-flex items-center px-6 py-3 rounded-lg font-medium transition-all
                                  {{ ($btn['primary'] ?? true) ? 'bg-white text-ctc-blue hover:bg-gray-100 shadow-md' : 'bg-white/10 text-white border border-white/30 hover:bg-white/20' }}">
                            {{ $btn['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif
            </div>
        </div>
    </div>
</section>
