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
        @include('links.filters')
    </div>
    <div class="lg:col-span-3 p-3">
        <div class="bg-white overflow-hidden sm:rounded-md">
            <ul role="list" class="">
                @if ($links)
                    @foreach ($links as $link)
        <a href="{{ route('links.show', $link)}}" class="flex">
            <div class="space-y-8 mt-3 shadow">
                <div class="bg-white border-t border-b border-gray-200 shadow-sm sm:border sm:rounded-lg">
              <div class="py-6 px-4 sm:px-6 lg:grid lg:grid-cols-12 lg:gap-x-8 lg:p-8">
                <div class="sm:flex lg:col-span-7">
                  <div class="flex-shrink-0 w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden sm:aspect-none sm:w-40 sm:h-40">
                    <img src="https://s29755.pcdn.co/wp-content/uploads/2019/08/2019_Top_Five_Class_5-Mack.jpg.webp" alt="Insulated bottle with white base and black snap lid." class="w-full h-full object-center object-cover sm:w-full sm:h-full">
                  </div>
                  <div class="mt-6 sm:mt-0 sm:ml-6">
                    <h3 class="text-xl font-medium text-gray-900 ">
                      <p class="text-xl font-medium text-gray-900">Plate Number: {{ $link->loadMatch->vehicle->plate_number ?? '' }} </p>
                    </h3>
                      <p class="mt-2 text-sm font-medium text-gray-900">
                        Load Code: {{ $link->loadMatch->code ?? '' }}
                      </p>
                      <p class="mt-2 text-sm font-medium text-gray-900">
                        Weight: {{ $link->loadMatch->weight ?? '' }}
                      </p>
                      <p class="mt-2 text-sm font-medium text-gray-900">
                        Volume: {{ $link->loadMatch->volume ?? '' }}
                      </p>
                      <p class="mt-2 text-sm font-medium text-gray-900">
                        State: {{ $link->loadMatch->state ?? '' }}
                      </p>
                      <p class="mt-2 text-sm font-medium text-gray-900">
                        Load type: {{ $link->loadMatch->load_type ?? '' }}
                      </p>
                  </div>
                </div>

                <div class="mt-6 lg:mt-0 lg:col-span-5">
                  <dl class="grid grid-cols-2 gap-x-6 text-sm">
                    <div>
                      <dt class="font-medium text-gray-900">Pickup</dt>
                      <dd class="mt-3 text-gray-500">
                        <p class="mt-2 text-sm font-medium text-gray-900">Location: {{ $link->loadMatch->pickupAddress->street_address.','. $link->loadMatch->pickupAddress->barangay.','.$link->loadMatch->pickupAddress->city.','.$link->loadMatch->pickupAddress->postcode  }} </p>
                        <p class="mt-2 text-sm font-medium text-gray-900">Date:  {{ Carbon\Carbon::parse($link->pickup_start)->format('F d,y h:m:s') }} </p>
                      </dd>
                    </div>
                    <div>
                      <dt class="font-medium text-gray-900">Destination</dt>
                      <dd class="mt-3 text-gray-500 space-y-3">
                        <p class="mt-2 text-sm font-medium text-gray-900">Location: {{ $link->movement->destinationAddress->street_address.','. $link->movement->destinationAddress->barangay.','.$link->movement->destinationAddress->city.','.$link->movement->destinationAddress->postcode  }} </p>
                        <p class="mt-2 text-sm font-medium text-gray-900">Date:  {{ Carbon\Carbon::parse($link->destination_end)->format('F d,y h:m:s') }} </p>
                      </dd>
                    </div>
                  </dl>
                </div>
              </div>
            </div>
            </div>
            </a>
            @endforeach
            </ul>
        </div>
        <div class="mt-3">
            {{ $links->links()}}
        </div>
        @endif
        <!-- /End replace -->
    </div>
