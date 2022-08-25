<x-app-layout>
    <x-slot name="header">
        {{ __('Create a load') }}
    </x-slot>
    <x-content-wrapper>
        <livewire:loads.create-load-component :wants-insurance="false"/>
    </x-content-wrapper>
</x-app-layout>
