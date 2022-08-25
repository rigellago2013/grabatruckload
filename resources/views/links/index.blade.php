<x-app-layout>

    <x-slot name="header">
        {{ __('Links') }}
    </x-slot>

    <x-slot name="headerLinks">

        <x-jetstream::button class="inline-flex items-center">
                <a href="{{ route('links.create') }}">Post a Link</a>
        </x-jetstream::button>

    </x-slot>

    <x-content-wrapper>
        <livewire:links.links-table-component/>
    </x-content-wrapper>

</x-app-layout>
