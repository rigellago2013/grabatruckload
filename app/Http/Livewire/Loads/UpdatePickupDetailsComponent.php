<?php

namespace App\Http\Livewire\Loads;

use App\Actions\Loads\UpdatePickupDetailsAction;
use App\Data\Loads\PickupDetailsData;
use App\Enums\LoadingEquipmentsEnum;
use App\Models\Load;
use App\Rules\PickUpDetailsRules;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class UpdatePickupDetailsComponent extends Component
{
    use PickUpDetailsRules;

    public Load $load;
    public string $company = '';
    public string $contactName = '';
    public string $phoneNumber = '';
    public string $email = '';
    public DateTime $pickupStart;
    public DateTime $pickupEnd;
    public string $street = '';
    public string $town = '';
    public string $postCode = '';
    public string $instructions = '';
    public array $pickUpEquipments = [];
    public string $pickupStartString = '';
    public string $pickupEndString = '';
    public array $extraEmails = [];
    public $inputs = [];
    public $i = 1;

    public function mount(Load $load): void
    {
        $this->pickupStart = Carbon::parse($this->pickupStartString);
        $this->pickupEnd = Carbon::parse($this->pickupEndString);
    }

    public function updatingPickupStartString($value): void
    {
        $this->pickupStart = Carbon::parse($value);
    }

    public function updatingPickupEndString($value): void
    {
        $this->pickupEnd = Carbon::parse($value);
    }

    public function render()
    {
        $loadingEquipment = LoadingEquipmentsEnum::labels();

        return view('livewire.loads.update-pickup-details-component', compact(['loadingEquipment']));
    }

    public function updatePickup(): void
    {
        $this->validate($this->rules());
        $data = PickupDetailsData::fromComponent($this);
        app(UpdatePickupDetailsAction::class)->execute($data);
        $this->redirect(route('loads.update-delivery-details', $this->load));
    }

    public function add($i): void
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i): void
    {
        unset($this->inputs[$i]);
    }
}
