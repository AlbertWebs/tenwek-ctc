@props([
    'name',
    'title',
    'specialization' => null,
    'bio' => null,
    'photo' => null,
])

<article class="rounded-xl bg-white border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow">
    <div class="aspect-[4/3] bg-ctc-grey-light flex items-center justify-center">
        @if($photo)
            <img src="{{ $photo }}" alt="{{ $name }}" class="w-full h-full object-cover">
        @else
            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        @endif
    </div>
    <div class="p-5">
        <h3 class="text-lg font-semibold text-gray-900">{{ $name }}</h3>
        <p class="text-ctc-blue font-medium text-sm mt-0.5">{{ $title }}</p>
        @if($specialization)
            <p class="text-gray-500 text-sm mt-1">{{ $specialization }}</p>
        @endif
        @if($bio)
            <p class="mt-3 text-gray-600 text-sm leading-relaxed line-clamp-3">{{ $bio }}</p>
        @endif
    </div>
</article>
