@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-pink-800 bg-opacity-50 rounded-md py-2 px-3 text-md font-medium text-pink-50 transition'
            : 'hover:bg-pink-800 rounded-md py-2 px-3 text-md font-medium text-pink-50 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
