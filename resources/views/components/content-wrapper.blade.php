<div {!! $attributes->merge(['class' => 'bg-white rounded-lg shadow overflow-hidden']) !!}  >
    <div class="lg:col-span-12">
        {{ $slot }}
    </div>
</div>
