<x-app-layout>
    <x-slot name="header">
        {{ __('Create a movement') }}
    </x-slot>

    <x-slot name="headerLinks">
        @can('load:create')
        <x-jetstream::button class="inline-flex items-center">
            <a href="{{ route('movements.index') }}">Find a Truck</a>
        </x-jetstream::button>
        @endcan
        @can('vehicle:create')
        <x-jetstream::button class="inline-flex items-center">
            <a href="{{ route('movements.create') }}">Post a Truck</a>
        </x-jetstream::button>
        @endcan
    </x-slot>

    <x-content-wrapper>
        <livewire:movements.create-movement-component />
    </x-content-wrapper>
</x-app-layout>
