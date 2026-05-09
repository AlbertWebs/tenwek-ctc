@props([
    'name',
    'label' => null,
    'value' => '',
    'id' => null,
    'help' => null,
    'minHeight' => '14rem',
])

@php
    $inputId = $id ?? 'trix_' . \Illuminate\Support\Str::slug(str_replace(['[', ']'], '-', $name), '_');
@endphp

<div>
    @if ($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif
    @if ($help)
        <p class="text-xs text-gray-500 mb-2">{{ $help }}</p>
    @endif
    <input type="hidden" name="{{ $name }}" id="{{ $inputId }}" value="{{ old($name, $value) }}">
    <trix-editor input="{{ $inputId }}" {{ $attributes->merge(['class' => 'w-full bg-white trix-content-admin'])->except(['name', 'label', 'value', 'help', 'minHeight']) }} style="min-height: {{ $minHeight }}"></trix-editor>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
