<x-app-layout>
    <x-slot name="header">
        {{ __('Vehicle Item') }}
    </x-slot>

    <x-content-wrapper>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Vehicle Information
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <div class="flex">
                    <div class="w-2/3">
                        <x-content-detail>
                            <x-slot name="label">Plate Number</x-slot>
                            {{ $vehicle->plate_number }}
                        </x-content-detail>
                        <x-content-detail>
                            <x-slot name="label">Notes</x-slot>
                            {{ $vehicle->notes }}
                        </x-content-detail>
                        <x-content-detail>
                            <x-slot name="label">Type</x-slot>
                            {{ $vehicle->type }}
                        </x-content-detail>
                        <x-content-detail>
                            <x-slot name="label">Category</x-slot>
                            {{ $vehicle->category }}
                        </x-content-detail>
                        <x-content-detail>
                            <x-slot name="label">Deck Length</x-slot>
                            {{ $vehicle->deck_length }}
                        </x-content-detail>
                        <x-content-detail>
                            <x-slot name="label">Maximum Capacity</x-slot>
                            {{ $vehicle->maximun_capacity }}
                        </x-content-detail>
                    </div>

                    <div class="w-2/3">
                        <div class="mt-3">
                            <label for="" class="text-sm font-medium text-gray-500"> Truck Photo</label>
                            <!-- src={{asset('img/logo.png')}} -->

                                <img class="object-cover shadow-lg rounded-lg" src="{{ $vehicle->getFirstMediaUrl('truckPictures') }}" alt="" width="90%" height="90%">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-content-wrapper>

    <x-content-wrapper class=" mt-6">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    OR/CR Copy
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <div class="flex">
                    <div class="w-1/2 p-6">
                        <div>
                            <img class="object-cover shadow-lg rounded-lg" src="https://img.philkotse.com/2019/11/30/vzF0dUU5/or-385b.jpg" alt="">
                        </div>
                    </div>
                    <div class="w-1/2 p-6">
                        <div>
                            <!-- src={{asset('img/logo.png')}} -->
                            <img class="object-cover shadow-lg rounded-lg" src="https://4.bp.blogspot.com/-6DlCHavDL9o/Vbsfuyis0wI/AAAAAAAAA8M/a4OLeZWeW44/s400/encumbered%2BCR%2BLTO.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-content-wrapper>
</x-app-layout>
