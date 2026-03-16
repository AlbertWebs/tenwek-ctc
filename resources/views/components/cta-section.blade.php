@props([
    'title',
    'description' => null,
    'buttonLabel' => 'Learn more',
    'buttonUrl' => null,
])

<section class="py-16 lg:py-20 bg-ctc-blue text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4">{{ $title }}</h2>
        @if($description)
            <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-8">{{ $description }}</p>
        @endif
        @if($buttonUrl)
            <a href="{{ $buttonUrl }}"
               class="inline-flex items-center px-6 py-3 rounded-lg font-medium bg-white text-ctc-blue hover:bg-gray-100 shadow-md transition-colors">
                {{ $buttonLabel }}
            </a>
        @endif
    </div>
</section>
