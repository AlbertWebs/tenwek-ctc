@props([
    'title',
    'subtitle' => null,
])

<div class="mb-10 lg:mb-12">
    <h2 class="font-headline text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-ctc-blue" data-ctc-split="lines">{{ $title }}</h2>
    @if($subtitle)
        <p class="mt-3 text-[0.95rem] leading-relaxed text-gray-600 max-w-2xl" data-ctc-reveal="fade-up" data-ctc-reveal-delay="0.08">{{ $subtitle }}</p>
    @endif
</div>
