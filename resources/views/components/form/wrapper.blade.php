<form {!! $attributes->merge(['class' => 'space-y-8 divide-y divide-gray-200']) !!}>
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
        <div>
            {{ $slot }}
        </div>
    </div>
</form>
