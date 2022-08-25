<div>
     <x-form.wrapper wire:submit.prevent="createMovement">
         <x-content-subtitle>
             Movement details and information
         </x-content-subtitle>

         <div class="mt-3 sm:mt-2 space-y-6 sm:space-y-5">

            <x-form.section>
                <x-slot name="label">Vehicle</x-slot>
                <x-form.select
                            id="vehicle"
                            name="vehicle"
                            :options="$vehicles"
                            wire:model="vehicle">

                            <x-slot name="desc">Please select a vehicle.</x-slot>
                </x-form.select>
            </x-form>

            <x-form.section>
                <x-slot name="label">Pickup Address</x-slot>
                <x-form.select
                            id="pickupAddress"
                            name="pickupAddress"
                            :options="$addresses"
                            wire:model="pickupAddress">

                            <x-slot name="desc">Please select start address.</x-slot>
                </x-form.select>
            </x-form>

            <x-form.section>
                    <x-slot name="label">Pickup Start</x-slot>
                    <x-form.input
                        id="pickupStartString"
                        type="datetime-local"
                        name="pickupStartString"
                        wire:model="pickupStartString">
                        <x-slot name="desc">Please enter date for pickup start.</x-slot>
                    </x-form.input>
                    @error('pickupStart')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Pickup End</x-slot>
                    <x-form.input
                        id="pickupEndString"
                        type="datetime-local"
                        name="pickupEndString"
                        wire:model="pickupEndString">
                        <x-slot name="desc">Please enter date for pickup end.</x-slot>
                    </x-form.input>
                    @error('pickupStart')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Destination Address</x-slot>
                    <x-form.select
                                id="destinationAddress"
                                name="destinationAddress"
                                :options="$addresses"
                                wire:model="destinationAddress">
                                <x-slot name="desc">Please select destination address.</x-slot>
                    </x-form.select>
                </x-form>

                <x-form.section>
                    <x-slot name="label">Destination Start</x-slot>
                    <x-form.input
                        id="destinationStartString"
                        type="datetime-local"
                        name="destinationStartString"
                        wire:model="destinationStartString">
                        <x-slot name="desc">Please enter date for pickup end.</x-slot>
                    </x-form.input>
                    @error('pickupStart')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Destination End</x-slot>
                    <x-form.input
                        id="destinationEndString"
                        type="datetime-local"
                        name="destinationEndString"
                        wire:model="destinationEndString">
                        <x-slot name="desc">Please enter date for pickup end.</x-slot>
                    </x-form.input>
                    @error('pickupStart')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

         </div>

         <div>
            <x-form.button-wrapper>
                 <a href="{{ route('trucks.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                 <x-form.button type="submit" button-type="primary" class="ml-3" wire:loading.class.remove="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:loading.class="bg-gray-500" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="createMovement" >Create Movement</span>
                    <span wire:loading wire:target="createMovement">Creating movement...</span>
                 </x-form.button>
             </x-form.button-wrapper>
         </div>

     </x-form.wrapper>
 </div>
