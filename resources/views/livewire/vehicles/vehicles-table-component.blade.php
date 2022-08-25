<div>
    <div class="bg-gray-50">
        <div class="fixed inset-0 flex z-40 sm:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>
            <div class="ml-auto relative max-w-xs w-full h-full bg-white shadow-xl py-4 pb-6 flex flex-col overflow-y-auto">
                <div class="px-4 flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                    <button type="button" class="-mr-2 w-10 h-10 bg-white p-2 rounded-md flex items-center justify-center text-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <span class="sr-only">Close menu</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @include('trucks.filters')
    </div>
    <div class="lg:col-span-3 p-3">
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach ($vehicles as $vehicle )
                <li>
                    <a href="{{ route('trucks.show', ['truck' => $vehicle]) }}" class="block hover:bg-gray-50">
                        <div class="flex items-center px-4 py-4 sm:px-6">
                            <div class="min-w-0 flex-1 flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </div>
                                <div class="min-w-0 flex-1 px-4 md:gap-4">
                                    <div class="flex justify-between">
                                        <p class="text-sm font-medium text-gray-700 truncate">{{ $vehicle->plate_number}}</p>
                                        <p class=" text-sm text-gray-700 text-right">
                                            Type: {{ $vehicle->type }}
                                        </p>
                                    </div>
                                    <div class="flex justify-between">
                                        <div>
                                            <div class="flex">
                                                <div class="mr-2">
                                                    <div class="mt-1 flex text-sm text-gray-700">

                                                        <div class=" text-sm">
                                                            <label for="candidates" class="font-medium text-gray-700"> Maximum Capacity: {{ $vehicle->maximum_capacity }}</label>
                                                            <p class="font-medium text-gray-700"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div>
                                                    <div class="mt-1 flex text-sm text-gray-700">

                                                        <div class=" text-sm">
                                                            <label for="candidates" class="font-medium text-gray-700">Delivery End</label>
                                                            <p class="font-medium text-gray-700"></p>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>

                                        </div>

                                        <div class="md:block">
                                            <div>
                                                <p class="mt-1 text-sm text-gray-700 text-right">
                                                    Cetgory: {{ $vehicle->category }}
                                                    <time datetime="2020-01-07"></time>
                                                </p>
                                                <!-- <div class="flex">
                                                    <p class="mt-1 flex justify-end text-sm text-gray-700 mr-2">

                                                        Weight:

                                                    </p>
                                                    <p class="mt-1 flex justify-end text-sm text-gray-700">

                                                        Asking Price:

                                                    </p>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-3">
            {{ $vehicles->links()}}
        </div>
        <!-- /End replace -->
    </div>
