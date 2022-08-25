<?php

namespace App\Http\Livewire\Movements;

use App\Actions\Links\CreateLinkAction;
use App\Actions\Movements\CreateMovementAction;
use App\Data\Movements\BasicData;
use App\Enums\StateEnum;
use App\Models\Address;
use App\Models\Load;
use App\Models\Vehicle;
use App\Rules\MovementDetailsRules;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class CreateMovementComponent extends Component
{
    use MovementDetailsRules;

    public string $vehicle = '';
    public string $pickupAddress = '';
    public string $pickupStartString = '';
    public string $pickupEndString = '';
    public string $destinationAddress = '';
    public string $destinationStartString = '';
    public string $destinationEndString = '';
    public DateTime $pickupStart;
    public DateTime $pickupEnd;
    public DateTime $destinationStart;
    public DateTime $destinationEnd;

    public function mount(): void
    {
        $this->pickupStart = Carbon::parse($this->pickupStartString);
        $this->pickupEnd = Carbon::parse($this->pickupEndString);
        $this->destinationStart = Carbon::parse($this->destinationStartString);
        $this->destinationEnd = Carbon::parse($this->destinationEndString);
        $this->pickupAddress = Address::first()->id;
        $this->destinationAddress = Address::first()->id;
    }

    public function render()
    {
        return view('livewire.movements.create-movement-component', [
            'addresses' => Address::all(),
            'vehicles' => Vehicle::all()->pluck('plate_number', 'id'),
        ]);
    }

    public function createMovement(): void
    {
        $this->validate($this->rules());
        $data = BasicData::fromComponent($this);
        $movement = app(CreateMovementAction::class)->execute($data);
        $load = $this->findLoadMatch();

        if (! is_null($load)) {
            app(CreateLinkAction::class)->execute($load, $movement);
        }
        $this->redirect(route('movements.index'));
    }

    public function updatingPickupStartString($value): void
    {
        $this->pickupStart = Carbon::parse($value);
    }

    public function updatingPickupEndString($value): void
    {
        $this->pickupEnd = Carbon::parse($value);
    }

    public function updatingDestinationStartString($value): void
    {
        $this->destinationStart = Carbon::parse($value);
    }

    public function updatingDestinationEndString($value): void
    {
        $this->destinationEnd = Carbon::parse($value);
    }

    public function findLoadMatch()
    {
        return Load::where('pickup_address_id', $this->pickupAddress)
        ->where('delivery_address_id', $this->destinationAddress)
        ->whereDate('delivery_start', Carbon::parse($this->destinationStart)->toDateTimeString())
        ->whereDate('delivery_end', Carbon::parse($this->destinationEnd)->toDateTimeString())
        ->whereDate('pickup_start', Carbon::parse($this->pickupStart)->toDateTimeString())
        ->whereDate('pickup_end', Carbon::parse($this->pickupEnd)->toDateTimeString())
        ->where('state', StateEnum::labels()['PUBLISHED'])
        ->first();
    }
}
