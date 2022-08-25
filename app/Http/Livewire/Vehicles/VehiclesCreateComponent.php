<?php

namespace App\Http\Livewire\Vehicles;

use App\Actions\Vehicles\CreateVehicleAction;
use App\Data\Vehicles\BasicData;
use App\Enums\LoadTypeEnum;
use App\Enums\TrailerOptionsEnum;
use App\Enums\VehicleCategoryEnum;
use App\Enums\VehicleTypeEnum;
use App\Rules\VehicleDetailsRules;
use Livewire\Component;
use Livewire\WithFileUploads;

class VehiclesCreateComponent extends Component
{
    use VehicleDetailsRules;
    use WithFileUploads;

    public string $loadType = '';
    public string $vehicleType = '';
    public string $plateNumber = '';
    public string $category = '';
    public string|null $notes = '';
    public int $deckLength = 0;
    public $or = [];
    public $cr = [];
    public $truckPicture = [];
    public string $trailerType = '';
    public string $trailerOption = '';
    public string $truckCategory = '';
    public string $truckType = '';
    public int $volume = 0;
    public int $weight = 0;

    public function render()
    {
        return view('livewire.vehicles.vehicles-create-component', [
            'loadTypes' => LoadTypeEnum::labels(),
            'categories' => VehicleCategoryEnum::labels(),
            'trailerTypes' => LoadTypeEnum::labels(),
            'trailerOptions' => TrailerOptionsEnum::labels(),
            'vehicleTypes' => VehicleTypeEnum::labels(),
        ]);
    }

    public function createVehicle(): void
    {
        // dd($this);
        $this->validate($this->rules());
        $data = BasicData::fromComponent($this);
        app(CreateVehicleAction::class)->execute($data);
        $this->redirect(route('trucks.index'));
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
}
