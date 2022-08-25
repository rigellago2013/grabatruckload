<x-app-layout>
    <x-slot name="header">
        {{ __('Trucks') }}
    </x-slot>

    <x-slot name="headerLinks">
        @can('vehicle:create')
        <x-jetstream::button class="inline-flex items-center">
            <a href="{{ route('trucks.index') }}">Find a Truck</a>
        </x-jetstream::button>
        @endcan
        @can('load:create')
        <x-jetstream::button class="inline-flex items-center">
            <a href="{{ route('trucks.create') }}">Post a Truck</a>
        </x-jetstream::button>
        @endcan
    </x-slot>

    <x-content-wrapper>
        <livewire:vehicles.vehicles-table-component />
    </x-content-wrapper>

</x-app-layout>