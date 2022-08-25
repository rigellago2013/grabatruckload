@props([ 'labelId' => ''])

<div class="flex items-center">
    <input
        {!! $attributes->merge(['class' => 'h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-300', 'id' => $labelId ]) !!}
        type="checkbox">
    <label for="{{ $labelId }}" class="block text-sm font-medium text-gray-700 sm:mt-px ml-2 pt-1" >
        {{ $slot }}
    </label>
</div>
