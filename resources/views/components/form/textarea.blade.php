<textarea {!! $attributes->merge(['class' => 'max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md']) !!}></textarea>
{{ $slot }}
<p class="mt-2 text-xs text-gray-500">{{ $desc ?? '' }}</p>