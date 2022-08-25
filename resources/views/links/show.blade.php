
<x-app-layout>
    <x-slot name="header">
        {{ __('Link Item') }}
    </x-slot>
    <x-content-wrapper>
        <div class="bg-white shadow overflow-hidden">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                Load
                </h3>
            </div>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
          <x-content-detail>
            <x-slot name="label">Code</x-slot>
            {{ $load->code }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Internal Code</x-slot>
            {{ $load->internal_code }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">State</x-slot>
            {{ $load->state }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Load Type</x-slot>
            {{ $load->load_type }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Weight</x-slot>
            {{ $load->weight }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Volume</x-slot>
            {{ $load->volume }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Company</x-slot>
            {{ $load->company }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Contact Name</x-slot>
            {{ $load->contact_name }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Phone number</x-slot>
            {{ $load->phone_number }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Email</x-slot>
            {{ $load->email_to_notify }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Emails to notify</x-slot>
            {{ $load->extra_emails }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Description</x-slot>
            {{ $load->description }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Instructions</x-slot>
            {{ $load->instructions }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Pickup Street</x-slot>
            {{ $load->pickupAddress->street_address }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Pickup Barangay</x-slot>
            {{ $load->pickupAddress->barangay }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Pickup City</x-slot>
            {{ $load->pickupAddress->city }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Pickup Province</x-slot>
            {{ $load->pickupAddress->province }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Pickup Postcode</x-slot>
            {{ $load->pickupAddress->postcode }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Pickup Start</x-slot>
            {{ $load->pickup_start->format('F d, Y H:m:s') }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Pickup End</x-slot>
            {{ $load->pickup_end->format('F d, Y H:m:s') }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Pickup Equipments</x-slot>
            {{ $pickupEquipments }}
          </x-content-detail>

          <!--break-->
          <x-content-detail>
            <x-slot name="label"> Delivery Street</x-slot>
            {{ $load->deliveryAddress->street_address }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Delivery Barangay</x-slot>
            {{ $load->deliveryAddress->barangay }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Delivery City</x-slot>
            {{ $load->deliveryAddress->city }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Delivery Province</x-slot>
            {{ $load->deliveryAddress->province }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Delivery Postcode</x-slot>
            {{ $load->deliveryAddress->postcode }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Delivery Start</x-slot>
            {{ $load->delivery_start->format('F d, Y H:m:s') }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Delivery End</x-slot>
            {{ $load->delivery_end->format('F d, Y H:m:s') }}
          </x-content-detail>
        </dl>
            </div>
    </x-content-wrapper>
    <x-content-wrapper class=" mt-6">
        <div class="bg-white shadow overflow-hidden ">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                   Movement
                </h3>
            </div>
        </div>

        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                <x-content-detail>
                    <x-slot name="label">Pick-up Street</x-slot>
                    {{ $movement->pickupAddress->street_address }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Pick-up Barangay</x-slot>
                    {{ $movement->pickupAddress->barangay }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Pick-up  City</x-slot>
                    {{ $movement->pickupAddress->city }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Pick-up Province</x-slot>
                    {{ $movement->pickupAddress->province }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Pick-up Postcode</x-slot>
                    {{ $movement->pickupAddress->postcode }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Destination Street</x-slot>
                    {{ $movement->destinationAddress->street_address }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Destination Barangay</x-slot>
                    {{ $movement->destinationAddress->barangay }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Destination City</x-slot>
                    {{ $movement->destinationAddress->city }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Destination Province</x-slot>
                    {{ $movement->destinationAddress->province }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label">Destination Postcode</x-slot>
                    {{ $movement->destinationAddress->postcode }}
                </x-content-detail>

                <x-content-detail>
                <x-slot name="label"> Destination Pickup Start</x-slot>
                    {{ $movement->pickup_start->format('F d, Y H:m:s') }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label"> Pickup End</x-slot>
                    {{ $movement->pickup_end->format('F d, Y H:m:s') }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label"> Pickup Start</x-slot>
                    {{ $movement->destination_start->format('F d, Y H:m:s') }}
                </x-content-detail>

                <x-content-detail>
                    <x-slot name="label"> Pickup End</x-slot>
                    {{ $movement->destination_end->format('F d, Y H:m:s') }}
                </x-content-detail>

                </dl>
            </div>


    </x-content-wrapper>

</x-app-layout>
