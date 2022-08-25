@props([
    'error' => null
])

<div {!! $attributes->merge(['class' => "relative"]) !!}
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-on:change="value = $event.target.value"
    x-init="new Pikaday({ field: $refs.input, 'format': 'DD/MM/YYYY', firstDay: 1 });">
    <div class="flex absolute inset-y-0 left-0 items-center pl-3 mb-1 pointer-events-none">
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
    </div>
    <input {!! $attributes->whereDoesntStartWith('wire:model') !!}
                x-ref="input"
                x-bind:value="value"
                type="text"
                class=" pl-10 block w-full shadow-sm sm:text-sm bg-white-50 bg-white-300 border border-gray-300
                @if($error) focus:ring-danger-500 focus:border-danger-500 border-danger-500 text-danger-500 pr-10
                @else focus:ring-primary-500 focus:border-primary-500 @endif rounded-md"/>
</div>
