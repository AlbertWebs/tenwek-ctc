@props([
    'value',
    'label',
])

<div class="text-center p-6 rounded-xl bg-white border border-gray-200 shadow-sm">
    <p class="text-3xl sm:text-4xl font-bold text-ctc-blue">{{ $value }}</p>
    <p class="mt-1 text-sm font-medium text-gray-600">{{ $label }}</p>
</div>
