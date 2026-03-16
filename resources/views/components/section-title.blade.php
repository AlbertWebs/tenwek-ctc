@props([
    'title',
    'subtitle' => null,
])

<div class="mb-10 lg:mb-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ $title }}</h2>
    @if($subtitle)
        <p class="mt-2 text-lg text-gray-600 max-w-2xl">{{ $subtitle }}</p>
    @endif
</div>
