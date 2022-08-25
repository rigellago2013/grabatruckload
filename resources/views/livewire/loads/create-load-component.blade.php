<div>
    <x-form.wrapper wire:submit.prevent="createLoad">
        <x-content-subtitle>
            Load Details and Information
        </x-content-subtitle>
        <div class="mt-3 sm:mt-2 space-y-6 sm:space-y-5">
            <x-form.section>
                <x-slot name="label">Load type</x-slot>
                <x-form.select
                            id="load-types"
                            name="load-types"
                            :options="$loadTypes"
                            wire:model="loadType">
                            <x-slot name="option">
                            <option value="">Select Load type</option>
                            </x-slot>

                @error('loadType')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.select>
            </x-form.section>

            <!--- Insert create image load -->
            <x-form.section>
                <x-slot name="label">Images</x-slot>
                <x-form.upload
                            type="file"
                            id="image-upload"
                            accept="images/*"
                            class="sr-only"
                            wire:model="images"
                            multiple>
                    <x-slot name="desc">Upload a image</x-slot>
                    <x-slot name="label">or drag and drop</x-slot>
                    <x-slot name="supportedFiles"> JPEG, GIF, ETC. up to 10MB</x-slot>
                    @error('images.*')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.upload>
                @if ($images)
                    @foreach($images as $image)
                        <div class="flex inline-flex mt-3">
                            <img src="{{ method_exists($image, 'temporaryUrl') ? $image->temporaryUrl() : ''  }}" class="w-32">
                        </div>
                    @endforeach
                @endif
            </x-form.section>

            <!--- Insert create file load -->
            <x-form.section>
                <x-slot name="label">Files</x-slot>
                    <x-form.upload
                                type="file"
                                id="file-upload"
                                accept="application/*"
                                class="sr-only"
                                wire:model="files">
                    <x-slot name="desc">Upload a file</x-slot>
                    <x-slot name="label">or drag and drop</x-slot>
                    <x-slot name="supportedFiles"> PDF, DOCS, ETC. up to 10MB</x-slot>
                    @error('files')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.upload>
                @if ($files)
                    @foreach($files as $file)
                        <div class="flex inline-flex mt-3">
                        <p>{{ $file->getClientOriginalName() }}, </p>
                        </div>
                    @endforeach
                @endif
            </x-form.section>

            <x-form.section>
                <x-slot name="label">Number of items</x-slot>
                <x-form.input
                            oninput="this.value = Math.abs(this.value)"
                            id="num-of-items"
                            type="number"
                            name="num-of-items"
                            wire:model="noOfItems">
                <x-slot name="desc">Please enter the number of pallets/boxes/items that are to be collected</x-slot>
                @error('noOfItems')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.input>
            </x-form.section>

            <x-form.section>
                <x-slot name="label">Total weight</x-slot>
                <x-form.input
                            oninput="this.value = Math.abs(this.value)"
                            type="number"
                            id="total-weight"
                            type="number"
                            name="total-weight"
                            min="0"
                            wire:model="weight">
                    <x-slot name="desc">Weight in kg.</x-slot>
                    @error('weight')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.input>
            </x-form.section>

            <x-form.section>
                <x-slot name="label">Total volume</x-slot>
                <x-form.input
                            oninput="this.value = Math.abs(this.value)"
                            id="total-volume"
                            type="number"
                            name="total-volume"
                            step=".01"
                            wire:model="volume">
                    <x-slot name="desc">Meters cubed.</x-slot>
                    @error('volume')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.input>
            </x-form.section>

            <x-form.section>
                <x-slot name="label">Description</x-slot>
                <x-form.textarea
                                id="about"
                                name="about"
                                rows="3"
                                wire:model="description">
                    <x-slot name="desc">Add any other notes or information for the driver here.</x-slot>
                    @error('description')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.textarea>
            </x-form.section>

            <x-form.section>
                <x-slot name="label">Customer reference (optional)</x-slot>
                <x-form.input
                            type="text"
                            id="reference"
                            wire:model="reference"
                            autocomplete="reference">
                    <x-slot name="desc">Enter your own reference number if you have one</x-slot>
                    @error('reference')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                </x-form.input>
            </x-form.section>

            <x-form.section>
                <x-slot name="label">Insurance</x-slot>
                <x-form.checkbox
                                id="tc-insurance"
                                name="tc-insurance"
                                type="checkbox"
                                wire:model="wantsInsurance"
                                >
                    <x-slot name="label">Yes I want insurance</x-slot>
                </x-form.checkbox>

                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                    @if ($wantsInsurance)
                    <input type="text"
                                name="value-of-goods"
                                id="value-of-goods"
                                autocomplete="value-of-goods"
                                class="max-w-lg block mt-1 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-lg sm:text-sm border-gray-300 rounded-md"
                                placeholder="Value of goods"
                                wire:model="valueOfGoods">

                        <div class="flex items-center mt-2">
                            <input
                                    id="filter-mobile-color-1"
                                    name="tc-insurance"
                                    value="beige"
                                    type="checkbox"
                                    class="h-4 w-4 border-gray-300 rounded text-indigo-300 focus:ring-indigo-300"
                                    wire:model="tcInsurance">
                            <label class="block text-sm font-medium text-gray-700 sm:mt-px ml-2 pt-1">
                                T&C of insurance
                            </label>
                        </div>
                    @endif
                    </div>
                </div>
            </x-form.section>

        </div>
        <div>
        <x-form.button-wrapper>
        <a href="{{ route('loads.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
            <x-form.button :wire-target="$wireTarget" type="submit" button-type="primary" class="ml-3" wire:loading.class.remove="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"  wire:target="createLoad" wire:loading.class="bg-gray-500" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="createLoad" >Create Load</span>
                <span wire:loading wire:target="createLoad">Creating load...</span>
            </x-form.button>
        </x-form.button-wrapper>
        </div>
    </x-form.wrapper>
</div>
