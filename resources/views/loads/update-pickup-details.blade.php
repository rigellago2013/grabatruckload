<x-app-layout>
    <x-slot name="header">
        {{ __('Pickup Details') }}
    </x-slot>
    <livewire:loads.update-pickup-details-component :load="$load"/>
</x-app-layout>
