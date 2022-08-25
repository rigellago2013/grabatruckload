<div>
    <x-content-wrapper>
        <x-form.wrapper wire:submit.prevent="updatePickup">
            <x-content-subtitle>
                Contact Information
            </x-content-subtitle>
            <div class="mt-3 sm:mt-2 space-y-6 sm:space-y-5 ">
                <x-form.section>
                    <x-slot name="label">Company</x-slot>
                    <x-form.input
                        id="company"
                        type="text"
                        name="company"
                        wire:model="company">
                        <x-slot name="desc">Please enter company name.</x-slot>
                    </x-form.input>
                    @error('company')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>
                <x-form.section>
                    <x-slot name="label">Contact name</x-slot>
                    <x-form.input
                        id="contactName"
                        type="text"
                        name="contactName"
                        wire:model="contactName">
                        <x-slot name="desc">Please enter contact name.</x-slot>
                    </x-form.input>
                    @error('contactName')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>
                <x-form.section>
                    <x-slot name="label">Phone Number</x-slot>
                    <x-form.input
                        id="phoneNumber"
                        type="text"
                        name="phoneNumber"
                        wire:model="phoneNumber">
                        <x-slot name="desc">Please enter phone number.</x-slot>
                    </x-form.input>
                    @error('phoneNumber')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section class="pb-3">
                    <x-slot name="label">Email to Notify</x-slot>
                    <x-form.input
                        id="email"
                        type="email"
                        name="email"
                        wire:model="email">
                        <x-slot name="desc">Please enter email to notify.</x-slot>
                    </x-form.input>
                    @error('email')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section class="pb-3">
                    <x-slot name="label">Extra emails to notify</x-slot>
                        <x-form.input
                            id="extraEmails.0"
                            type="email"
                            name="extraEmails.0"
                            wire:model="extraEmails.0"
                            c>
                            <x-slot name="desc">Please enter email to notify.</x-slot>
                        </x-form.input>
                         @error('extraEmails.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="add({{$i}})">Add</button>
                    @foreach($inputs as $key => $value)
                        <x-form.input
                            id="extraEmails.{{ $value }}"
                            type="email"
                            name="extraEmails.{{ $value }}"
                            wire:model="extraEmails.{{ $value }}"
                            class="mt-3">
                        </x-form.input>
                        @error('extraEmails.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="remove({{$key}})">remove</button>
                    @endforeach
                </x-form.section>
            </div>
        </x-form.wrapper>
    </x-content-wrapper>

    <x-content-wrapper class="mt-5">
        <x-form.wrapper wire:submit.prevent="updatePickup">
            <x-content-subtitle>
                Pickup Details
            </x-content-subtitle>

            <div class="mt-3 sm:mt-2 space-y-6 sm:space-y-5">

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
                    @error('pickupEndString')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Street Address</x-slot>
                    <x-form.input
                        id="street"
                        type="text"
                        name="street"
                        wire:model="street">
                        <x-slot name="desc">Please enter street details.</x-slot>
                    </x-form.input>
                    @error('street')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Town</x-slot>
                    <x-form.input
                        id="town"
                        type="text"
                        name="town"
                        wire:model="town">
                        <x-slot name="desc">Please enter a town.</x-slot>
                    </x-form.input>
                    @error('town')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>


                <x-form.section>
                    <x-slot name="label">Post Code</x-slot>
                    <x-form.input
                        id="postCode"
                        type="number"
                        name="postCode"
                        wire:model="postCode"
                        oninput="this.value = Math.abs(this.value)">
                        <x-slot name="desc">Please enter Post Code.</x-slot>
                    </x-form.input>
                    @error('postCode')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Instructions</x-slot>
                    <x-form.textarea
                        id="instructions"
                        name="instructions"
                        rows="3"
                        wire:model="instructions">
                        <x-slot name="desc">Please specify any special instructions for driver.</x-slot>

                    </x-form.textarea>
                    @error('instructions')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Equipment Required</x-slot>
                    <fieldset class="space-y-5">
                        @foreach($loadingEquipment as $key => $option)
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="{{ $option }}" wire:model="pickUpEquipments.{{ $key }}" aria-describedby="comments-description" value='{{ $option }}' type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="comments" class="font-medium text-gray-700">{{ $option }}</label>
                                </div>
                            </div>
                        @endforeach
                    </fieldset>
                    @error('pickUpEquipments')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.button-wrapper>
                    <a href="{{ route('loads.create') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                    <x-form.button
                        type="submit"
                        button-type="primary"
                        class="ml-3"
                        wire:loading.class.remove="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:target="updatePickup"
                        wire:loading.class="bg-gray-500"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updatePickup">Create Pickup Details</span>
                        <span wire:loading wire:target="updatePickup">Creating Pickup...</span>
                    </x-form.button>
                </x-form.button-wrapper>

            </div>
        </x-form.wrapper>
    </x-content-wrapper>
</div>
