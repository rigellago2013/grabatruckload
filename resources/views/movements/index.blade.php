<x-app-layout>
    <x-slot name="header">
        {{ __('Movements') }}
    </x-slot>

    <x-slot name="headerLinks">
        @can('vehicle:create')
        <x-jetstream::button class="inline-flex items-center">
            <a href="{{ route('movements.index') }}">Find a Movement</a>
        </x-jetstream::button>
        @endcan
        @can('load:create')
        <x-jetstream::button class="inline-flex items-center">
            <a href="{{ route('movements.create') }}">Post a Movemet</a>
        </x-jetstream::button>
        @endcan
    </x-slot>

    <x-content-wrapper>
        <livewire:movements.movements-table-component/>
    </x-content-wrapper>

</x-app-layout>
