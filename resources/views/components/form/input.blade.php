<input {!! $attributes->merge(['class' => 'max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md']) !!}  />
{{ $slot }}
<p class="mt-2 text-xs text-gray-500">{{ $desc ?? '' }}</p>