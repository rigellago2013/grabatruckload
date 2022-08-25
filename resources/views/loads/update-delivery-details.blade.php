<x-app-layout>
    <x-slot name="header">
        {{ __('Delivery Details') }}
    </x-slot>
    <livewire:loads.update-delivery-details-component :load="$load"/>
</x-app-layout>
