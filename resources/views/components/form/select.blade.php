@props(['options' => []])
<select {!! $attributes->merge(['class' => 'max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-lg sm:text-sm border-gray-300 rounded-md']) !!} >
    @foreach($options as $key => $option)
        <option value="{{isset($option->id) ? $option->id : $key  }}">
            {{  isset($option->province) &&  isset($option->street_address ) ? $option->street_address.' - '.$option->province : $option  }}
        </option>
    @endforeach
</select>
{{ $slot }}
<p class="mt-2 text-xs text-gray-500">{{ $desc ?? '' }}</p>
