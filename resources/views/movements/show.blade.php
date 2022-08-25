<x-app-layout>
    <x-slot name="header">
        {{ __('Vehicle Item') }}
    </x-slot>
    <x-content-wrapper>
        <div class="bg-white shadow overflow-hidden">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Movement Information
                </h3>
            </div>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                <x-content-detail>
                    <x-slot name="label">Pickup Start</x-slot>
                    {{ Carbon\Carbon::parse($movement->pickup_start)->format('F d,y h:m:s') }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Pickup End</x-slot>
                    {{ Carbon\Carbon::parse($movement->pickup_end)->format('F d,y h:m:s') }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Destination Start</x-slot>
                    {{ Carbon\Carbon::parse($movement->destination_start)->format('F d,y h:m:s') }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Destination End</x-slot>
                    {{ Carbon\Carbon::parse($movement->destination_end)->format('F d,y h:m:s') }}
                </x-content-detail>
                </dl>
            </div>
    </x-content-wrapper>

    <x-content-wrapper class=" mt-6">
        <div class="bg-white shadow overflow-hidden ">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                   Pickup
                </h3>
            </div>
        </div>

        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                <x-content-detail>
                    <x-slot name="label">Street</x-slot>
                    {{ $movement->pickupAddress->street_address }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Barangay</x-slot>
                    {{ $movement->pickupAddress->barangay }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">City</x-slot>
                    {{ $movement->pickupAddress->city }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Province</x-slot>
                    {{ $movement->pickupAddress->province }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Postcode</x-slot>
                    {{ $movement->pickupAddress->postcode }}
                </x-content-detail>
                </dl>
            </div>


    </x-content-wrapper>

    <x-content-wrapper class=" mt-6">
    <div class="bg-white shadow overflow-hidden">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                   Destination
                </h3>
            </div>

            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                <x-content-detail>
                    <x-slot name="label">Street</x-slot>
                    {{ $movement->destinationAddress->street_address }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Barangay</x-slot>
                    {{ $movement->destinationAddress->barangay }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">City</x-slot>
                    {{ $movement->destinationAddress->city }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Province</x-slot>
                    {{ $movement->destinationAddress->province }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Postcode</x-slot>
                    {{ $movement->destinationAddress->postcode }}
                </x-content-detail>
                </dl>
            </div>
        </div>
    </x-content-wrapper>

    <x-content-wrapper class="mt-6 sm:mt-6">
    <x-content-header>
      Pickup and delivery location
    </x-content-header>
    <div class="px-4 py-5 sm:p-0">
      <dl class="sm:divide-y sm:divide-gray-200">
        <x-maps-leaflet :centerPoint="$centerPoint" :zoomLevel="8" :markers="$markers"></x-maps-leaflet>
      </dl>
    </div>
  </x-content-wrapper>
</x-app-layout>
