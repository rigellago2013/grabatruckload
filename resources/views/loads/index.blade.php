<x-app-layout>
    <x-slot name="header">
        {{ __('Loads') }}
    </x-slot>

    <x-slot name="headerLinks">
        @can('vehicle:create')
        <x-jetstream::button class="inline-flex items-center">
            <a href="{{ route('loads.index') }}">Find a Load</a>
        </x-jetstream::button>
        @endcan
        @can('load:create')
        <x-jetstream::button class="inline-flex items-center">
            <a href="{{ route('loads.create') }}">Post a Load</a>
        </x-jetstream::button>
        @endcan
    </x-slot>

    <x-content-wrapper>
        <livewire:loads.loads-table-component/>
    </x-content-wrapper>

</x-app-layout>
