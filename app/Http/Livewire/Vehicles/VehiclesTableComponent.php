<?php

namespace App\Http\Livewire\Vehicles;

use App\Actions\Vehicles\SearchVehicles;
use App\Data\Vehicles\SearchVehiclesData;
use App\Enums\VehicleSortDataEnum;
use App\Models\Vehicle;
use App\Rules\SearchVehicleRules;
use Livewire\Component;
use Livewire\WithPagination;

class VehiclesTableComponent extends Component
{
    use WithPagination;
    use SearchVehicleRules;

    public string $searchTerm = '';
    public string $loadType = '';
    public string $vehicleCategory = '';
    public string $sort = '';

    public function render()
    {
        return view('livewire.vehicles.vehicles-table-component', [
            'vehicles' => $this->searchVehicles(),
            'sortData' => VehicleSortDataEnum::labels(),
        ]);
    }

    public function searchVehicles()
    {
        $this->validate($this->rules());
        $data = SearchVehiclesData::fromComponent($this);

        return app(SearchVehicles::class)->execute($data);
    }

    public function getVehicles()
    {
        return Vehicle::paginate(25);
    }

    public function clearAll()
    {
        $this->searchTerm = '';
        $this->loadType = '';
        $this->vehicleCategory = '';
        $this->sort = '';

        return redirect('/trucks');
    }
}
