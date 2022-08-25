<div>
    <div class="relative flex bg-white p-2 space-x-1">
        <div class="w-64">
            <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Search Term
            </label>
            <x-form.input type="text" name="search" placeholder="Search term" wire:model.defer="searchTerm"></x-form.input>
        </div>
        <div class="w-64">
            <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Vehicle Type
            </label>
            <x-form.select :options="['all' => 'All types'] + \App\Enums\VehicleTypeEnum::labels()" wire:model.defer="loadType"></x-form.select>
        </div>
        <div class="w-64">
            <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Vehicle Category
            </label>
            <x-form.select :options="['all' => 'All categories'] + \App\Enums\VehicleCategoryEnum::labels()" wire:model.defer="vehicleCategory"></x-form.select>
        </div>
        <!-- <div class="w-64">
            <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Vehicle type
            </label>
            <x-form.select :options="[]" wire:model.defer="loadType"></x-form.select>
        </div> -->
        <div class="w-40">
            <label for="first-name" class="invisible block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Search
            </label>
            <x-form.button class="w-full" buttonType="primary" wire:click="searchVehicles">Search</x-form.button>
        </div>
    </div>
    <section x-data="{ open: false }" aria-labelledby="filter-heading" class="relative z-10 border-t border-b border-gray-200 grid items-center">
        <h2 id="filter-heading" class="sr-only">Filters</h2>
        <div class="relative col-start-1 row-start-1 py-4">
            <div class="max-w-7xl mx-auto flex space-x-6 divide-x divide-gray-200 text-sm px-4 sm:px-6 lg:px-8">

                <div class="">
                    <button type="button" class="text-gray-500" wire:click="clearAll">Clear all</button>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-200 py-10" id="disclosure-1" x-show="open" style="display: none;">
            <div class="max-w-7xl mx-auto grid grid-cols-1 gap-x-4 px-4 text-sm sm:px-6 md:gap-x-6 lg:px-8">
                <div class="grid grid-cols-1 gap-y-10 auto-rows-min md:grid-cols-3 md:gap-x-6">

                </div>
            </div>
        </div>

        <div class="col-start-1 row-start-1 py-4">
            <div class="flex justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div x-data="{ isSortOpen: false }" class="relative inline-block">
                    <div class="flex">
                        <button type="button"
                        @click="isSortOpen = !isSortOpen"
                        class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                        id="menu-button"
                        x-ref="button"
                        aria-expanded="false"
                        aria-haspopup="true">
                            Sort
                            <svg class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: solid/chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <div x-show="isSortOpen"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                        x-ref="menu-items"
                        x-description="Dropdown menu, show/hide based on menu state."
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="menu-button"
                        tabindex="-1"
                        style="display: none;"
                        x-on:click.away="isSortOpen = !isSortOpen">
                        <div class="py-1" role="none">
                        @foreach ( $sortData as $key => $sort)
                                <a
                                    class="font-medium text-gray-900 block px-4 py-2 text-sm"
                                    x-state:on:option.current="Selected"
                                    x-state:off:option.current="Not Selected"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="menu-item-0"
                                    wire:model.defer="sort"
                                    x-on:click="isSortOpen = !isSortOpen"
                                    wire:click="$set('sort', '{!! $key !!}')"
                                    >
                                    {{ $sort }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
