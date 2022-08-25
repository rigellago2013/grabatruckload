 <div>
     <x-form.wrapper  wire:submit.prevent="createVehicle">
         <x-content-subtitle>
             Truck Details and Information
         </x-content-subtitle>
         <div class="mt-3 sm:mt-2 space-y-6 sm:space-y-5">

             <x-form.section>
                 <x-slot name="label">Load type</x-slot>
                 <x-form.select id="loadType" name="loadType" :options="$loadTypes" wire:model="loadType">
                     <x-slot name="option">
                         <option value="">Select Load type</option>
                     </x-slot>
                     @error('loadType')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.select>
             </x-form.section>

             <x-form.section>
                 <x-slot name="label">Vehicle type</x-slot>
                 <x-form.select id="vehicleType" name="vehicleType" :options="$vehicleTypes" wire:model="vehicleType">
                     <x-slot name="option">
                         <option value="">Select Vehicle type</option>
                     </x-slot>
                     @error('loadType')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.select>
             </x-form.section>

             <x-form.section>
                 <x-slot name="label">Category</x-slot>
                 <x-form.select id="category" name="category" :options="$categories" wire:model="category">
                     <x-slot name="option">
                         <option value="">Select category type</option>
                     </x-slot>

                     @error('loadType')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.select>
             </x-form.section>

             <x-form.section>
                 <x-slot name="label">Plate number</x-slot>
                 <x-form.input type="text" id="plateNumber" wire:model="plateNumber" autocomplete="plateNumber">
                     @error('plateNumber')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.input>
             </x-form.section>


             <x-form.section>
                 <x-slot name="label">Notes</x-slot>
                 <x-form.textarea id="notes" name="notes" rows="3" wire:model="notes">
                     <x-slot name="desc">Add any extra notes about the vehicle here.</x-slot>
                     @error('notes')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.textarea>
             </x-form.section>

             <x-form.section>
                 <x-slot name="label">Or</x-slot>
                 <x-form.upload type="file" id="or" accept="images/*" class="sr-only" wire:model="or">
                     <x-slot name="desc">Upload image</x-slot>
                     <x-slot name="label">or drag and drop</x-slot>
                     <x-slot name="supportedFiles"> JPEG, GIF, ETC. up to 10MB</x-slot>
                     @error('or')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.upload>
                 @if ($or)
                    <div class="flex inline-flex mt-3">
                        <img src="{{ method_exists($or, 'temporaryUrl') ? $or->temporaryUrl() : ''  }}" class="w-32">
                    </div>
                @endif
             </x-form.section>

             <x-form.section>
                 <x-slot name="label">CR</x-slot>
                 <x-form.upload type="file" id="cr" accept="images/*" class="sr-only" wire:model="cr">
                     <x-slot name="desc">Upload image</x-slot>
                     <x-slot name="label">or drag and drop</x-slot>
                     <x-slot name="supportedFiles"> JPEG, GIF, ETC. up to 10MB</x-slot>
                     @error('cr.*')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.upload>
                 @if ($cr)
                    <div class="flex inline-flex mt-3">
                        <img src="{{ method_exists($cr, 'temporaryUrl') ? $cr->temporaryUrl() : ''  }}" class="w-32">
                    </div>
                @endif
             </x-form.section>

             <x-form.section>
                 <x-slot name="label">Photo of truck (inc. plate)</x-slot>
                 <x-form.upload type="file" id="truckPicture" accept="images/*" class="sr-only" wire:model="truckPicture">
                     <x-slot name="desc">Upload image</x-slot>
                     <x-slot name="label">or drag and drop</x-slot>
                     <x-slot name="supportedFiles"> JPEG, GIF, ETC. up to 10MB</x-slot>
                     @error('truckPicture.*')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.upload>
                 @if ($truckPicture)
                    <div class="flex inline-flex mt-3">
                        <img src="{{ method_exists($truckPicture, 'temporaryUrl') ? $truckPicture->temporaryUrl() : ''  }}" class="w-32">
                    </div>
                @endif
             </x-form.section>

             @if ($vehicleType == "trailer" || $vehicleType == "van" || $vehicleType == "truck" )
                <x-form.section>
                    <x-slot name="label">Deck Length (m)</x-slot>
                    <x-form.input type="number" id="deckLength" wire:model="deckLength" autocomplete="deckLength">
                        @error('deckLength')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                    </x-form.input>
                </x-form.section>
             @endif

             @if ($vehicleType == "trailer")
             <x-form.section>
                 <x-slot name="label">Trailer Type</x-slot>
                 <x-form.select id="trailerType" name="trailerType" :options="$trailerTypes" wire:model="trailerType">
                     <x-slot name="option">
                         <option value="">Select trailer type</option>
                     </x-slot>
                     @error('trailerType')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.select>
             </x-form.section>
             @endif

             @if ($vehicleType == "trailer" || $vehicleType == "van" || $vehicleType == "truck" )
             <x-form.section>
                 <x-slot name="label">Trailer options</x-slot>
                 <x-form.input type="text" id="trailerOption" wire:model="trailerOption" autocomplete="trailerOption">
                     @error('trailerOption')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.input>
             </x-form.section>
             @endif

             @if ($vehicleType == "van" || $vehicleType == "truck" )
             <x-form.section>
                 <x-slot name="label">Van/Truck Type</x-slot>
                 <x-form.select id="truckType" name="truckType" :options="$trailerTypes" wire:model="truckType">
                     <x-slot name="option">
                         <option value="">Select trailer type</option>
                     </x-slot>
                     @error('truckType')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.select>
             </x-form.section>
             @endif

             @if ($vehicleType == "van" || $vehicleType == "truck" )
             <x-form.section>
                 <x-slot name="label">Van/Truck Category</x-slot>
                 <x-form.select id="truckCategory" name="truckCategory" :options="$categories" wire:model="truckCategory">
                     <x-slot name="option">
                         <option value="">Select category type</option>
                     </x-slot>
                     @error('truckCategory')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.select>
             </x-form.section>
             @endif


             <!-- <x-form.section>
                 <x-slot name="label">Volume (m3)</x-slot>
                 <x-form.input type="text" id="volume" wire:model="volume" autocomplete="volume">
                     @error('volume')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.input>
             </x-form.section> -->

             <x-form.section>
                 <x-slot name="label">Weight (kg)</x-slot>
                 <x-form.input type="text" id="weight" wire:model="weight" autocomplete="weight">
                     @error('weight')<p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>@enderror
                 </x-form.input>
             </x-form.section>
         </div>
         <div>
             <x-form.button-wrapper>
                 <a href="{{ route('trucks.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                 <x-form.button type="submit" button-type="primary" class="ml-3" wire:loading.class.remove="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:loading.class="bg-gray-500" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="createVehicle" >Create Load</span>
                    <span wire:loading wire:target="createVehicle">Creating load...</span>
                 </x-form.button>
             </x-form.button-wrapper>
         </div>

     </x-form.wrapper>
 </div>
