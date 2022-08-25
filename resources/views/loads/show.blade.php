<x-app-layout>
  <x-slot name="header">
    {{ __('Load Item') }}
  </x-slot>
  <x-content-wrapper>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          Load Information
        </h3>
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
        </dl>
      </div>
    </div>
  </x-content-wrapper>
  <x-content-wrapper class="mt-6 sm:mt-6">
    <div class=" bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          Pickup Information
        </h3>
      </div>
      <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
          <x-content-detail>
            <x-slot name="label"> Pickup Street</x-slot>
            {{ $pickupAddress->street_address }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label"> Pickup Barangay</x-slot>
            {{ $pickupAddress->barangay }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Pickup City</x-slot>
            {{ $pickupAddress->city }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Pickup Province</x-slot>
            {{ $pickupAddress->province }}
          </x-content-detail>

          <x-content-detail>
            <x-slot name="label">Pickup Postcode</x-slot>
            {{ $pickupAddress->postcode }}
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
        </dl>
        <!--end -->
      </div>
    </div>
  </x-content-wrapper>
  <x-content-wrapper class="mt-6 sm:mt-6">
    <x-content-header>
      Delivery Information
    </x-content-header>
    <div class="px-4 py-5 sm:p-0">
      <dl class="sm:divide-y sm:divide-gray-200">
        <x-content-detail>
          <x-slot name="label">Delivery Street Address</x-slot>
          {{ $deliveryAddress->street_address }}
        </x-content-detail>

        <x-content-detail>
          <x-slot name="label">Delivery Barangay</x-slot>
          {{ $deliveryAddress->barangay }}
        </x-content-detail>

        <x-content-detail>
          <x-slot name="label">Delivery City</x-slot>
          {{ $deliveryAddress->city }}
        </x-content-detail>

        <x-content-detail>
          <x-slot name="label">Delivery Province</x-slot>
          {{ $deliveryAddress->province }}
        </x-content-detail>

        <x-content-detail>
          <x-slot name="label">Delivery Postcode</x-slot>
          {{ $deliveryAddress->postcode }}
        </x-content-detail>

        <x-content-detail>
          <x-slot name="label">Delivery Start</x-slot>
          {{ $load->delivery_start->format('F d, Y H:m:s') }}
        </x-content-detail>

        <x-content-detail>
          <x-slot name="label"> Delivery End</x-slot>
          {{ $load->delivery_end->format('F d, Y H:m:s') }}
        </x-content-detail>

        <x-content-detail>
          <x-slot name="label"> Delivery Equipments</x-slot>
          {{ $deliveryEquipments }}
        </x-content-detail>
      </dl>
    </div>
  </x-content-wrapper>
  <x-content-wrapper class="mt-6 sm:mt-6">
    <x-content-header>
      Pricing Information
    </x-content-header>
    <div class="px-4 py-5 sm:p-0">
      <dl class="sm:divide-y sm:divide-gray-200">

        <x-content-detail>
          <x-slot name="label">Asking Price</x-slot>
          {{ $load->customer_max_amount }}
        </x-content-detail>
      </dl>
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