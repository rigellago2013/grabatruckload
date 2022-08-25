<div>
<x-content-wrapper>
    <x-form.wrapper wire:submit.prevent="updateDelivery">
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
                    <x-slot name="label">Phone number</x-slot>
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
                    <x-slot name="label">Email</x-slot>
                    <x-form.input
                            id="email"
                            type="email"
                            name="email"
                            wire:model="email">
                        <x-slot name="desc">Please enter email.</x-slot>
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
        <x-form.wrapper wire:submit.prevent="updateDelivery">
            <x-content-subtitle>
                    Time and location
            </x-content-subtitle>

            <div class="mt-3 sm:mt-2 space-y-6 sm:space-y-5">

                <x-form.section>
                    <x-slot name="label">Delivery start</x-slot>
                    <x-form.input
                            id="deliveryStartString"
                            type="datetime-local"
                            name="deliveryStartString"
                            wire:model="deliveryStartString">
                        <x-slot name="desc">Please enter date for pickup start.</x-slot>
                    </x-form.input>
                    @error('deliveryStartString')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Delivery end</x-slot>
                    <x-form.input
                            id="deliveryEndString"
                            type="datetime-local"
                            name="deliveryEndString"
                            wire:model="deliveryEndString">
                        <x-slot name="desc">Please enter date for pickup end.</x-slot>
                    </x-form.input>
                    @error('deliveryEndString')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.section>
                    <x-slot name="label">Street address</x-slot>
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
                    <x-slot name="label">Post code</x-slot>
                    <x-form.input
                            id="postCode"
                            type="text"
                            name="postCode"
                            wire:model="postCode">
                        <x-slot name="desc">Please enter a region.</x-slot>
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
                        <x-slot name="desc">Please specify instructions here.</x-slot>

                        </x-form.textarea>
                        @error('instructions')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>


                <x-form.section>
                    <x-slot name="label">Equipment required </x-slot>
                    <fieldset class="space-y-5">
                        @foreach($loadingEquipment as $key => $option)
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="{{ $option }}" wire:model="deliveryEquipments.{{ $key }}" aria-describedby="comments-description" value='{{ $option }}' type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="comments" class="font-medium text-gray-700">{{ $option }}</label>
                                </div>
                            </div>
                        @endforeach
                    </fieldset>
                    @error('deliveryEquipments')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.section>

                <x-form.button-wrapper>
                <a href="{{ route('loads.update-pickup-details',['load' => $load ]) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                    <x-form.button
                                    type="submit"
                                    button-type="primary"
                                    class="ml-3"
                                    wire:loading.class.remove="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    wire:target="updateDelivery"
                                    wire:loading.class="bg-gray-500"
                                    wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updateDelivery" >Create Delivery Details</span>
                        <span wire:loading wire:target="updateDelivery">Creating Delivery...</span>
                    </x-form.button>
                </x-form.button-wrapper>
            </div>
        </x-form.wrapper>
    </x-content-wrapper>
</div>

