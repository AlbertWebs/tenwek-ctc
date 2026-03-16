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
   class="block p-6 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md hover:border-ctc-blue/30 transition-all duration-200 group">
    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-ctc-blue transition-colors">{{ $name }}</h3>
    @if($description)
        <p class="mt-2 text-gray-600 text-sm leading-relaxed">{{ $description }}</p>
    @endif
</{{ $tag }}>
