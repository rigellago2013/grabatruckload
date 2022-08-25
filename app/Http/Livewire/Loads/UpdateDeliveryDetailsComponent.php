<?php

namespace App\Http\Livewire\Loads;

use App\Actions\Loads\UpdateDeliveryDetailsAction;
use App\Data\Loads\DeliveryDetailsData;
use App\Enums\LoadingEquipmentsEnum;
use App\Models\Load;
use App\Rules\DeliveryDetailsRules;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class UpdateDeliveryDetailsComponent extends Component
{
    use DeliveryDetailsRules;

    public Load $load;
    public string $company = '';
    public string $contactName = '';
    public string $phoneNumber = '';
    public string $email = '';
    public DateTime $deliveryStart;
    public DateTime $deliveryEnd;
    public string $street = '';
    public string $town = '';
    public string $postCode = '';
    public string $instructions = '';
    public array $deliveryEquipments = [];
    public string $deliveryStartString = '';
    public string $deliveryEndString = '';
    public array $extraEmails = [];
    public $inputs = [];
    public $i = 1;

    public function mount(Load $load): void
    {
        $this->deliveryStart = Carbon::parse($this->deliveryStartString);
        $this->deliveryEnd = Carbon::parse($this->deliveryEndString);
    }

    public function updatingDeliveryStartString($value): void
    {
        $this->deliveryStart = Carbon::parse($value);
    }

    public function updatingDeliveryEndString($value): void
    {
        $this->deliveryEnd = Carbon::parse($value);
    }

    public function updateDelivery(): void
    {
        $data = DeliveryDetailsData::fromComponent($this);
        app(UpdateDeliveryDetailsAction::class)->execute($data);

        $this->redirect(route('loads.index'));
    }

    public function render()
    {
        $loadingEquipment = LoadingEquipmentsEnum::labels();

        return view('livewire.loads.update-delivery-details-component', compact('loadingEquipment'));
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
