@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'bg-pink-50 border-pink-500 text-pink-700 hover:bg-pink-50 hover:text-pink-700 group border-l-4 px-3 py-2 flex items-center text-sm font-medium transition'
                : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium transition';
    $svgClasses = ($active ?? false)
                ? 'border-transparent text-pink-900 hover:bg-pink-50 hover:text-pink-900 group-hover:text-pink-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6'
                : 'bg-pink-50 border-pink-500 text-pink-700 hover:bg-pink-50 hover:text-pink-700 text-pink-400 group-hover:text-pink-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6'
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} aria-current="page">
    <svg {{ $attributes->merge(['class' => $svgClasses]) }}
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="truncate">{{ $slot }}</span>
</a>
