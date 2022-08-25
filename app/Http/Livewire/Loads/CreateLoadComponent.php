<?php

namespace App\Http\Livewire\Loads;

use App\Actions\Links\CreateLinkAction;
use App\Actions\Loads\CreateLoadAction;
use App\Actions\Loads\PublishLoad;
use App\Data\Loads\BasicData;
use App\Enums\LoadTypeEnum;
use App\Models\Movement;
use App\Models\User;
use App\Rules\LoadBasicDataRules;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLoadComponent extends Component
{
    use LoadBasicDataRules;
    use WithFileUploads;

    public string $description = '';
    public $files = [];
    public $images = [];
    public string $loadType = '';
    public int $noOfItems = 0;
    public string $reference = '';
    public float $volume = 0;
    public bool $wantsInsurance = false;
    public int $weight = 0;
    public int $valueOfGoods = 0;
    public bool $tcInsurance = false;
    public User $user;

    public function createLoad(): void
    {
        $this->validate($this->rules());

        if (! $this->wantsInsurance) {
            $this->valueOfGoods = 0;
            $this->tcInsurance = false;
        }
        $data = BasicData::fromComponent($this);
        $load = app(CreateLoadAction::class)->execute($data);
        $movement = $this->findMovementMatch($load);

        if (! is_null($movement)) {
            app(PublishLoad::class)->execute($load);
            app(CreateLinkAction::class)->execute($load, $movement);
        }

        $this->redirect(route('loads.update-pickup-details', $load));
    }

    public function mount(bool $wantsInsurance = false): void
    {
        $this->wantsInsurance = $wantsInsurance;
    }

    public function render()
    {
        return view('livewire.loads.create-load-component', [
            'loadTypes' => LoadTypeEnum::labels(),
            'wireTarget' => 'createLoad',
            'wantsInsurance' => false,
        ]);
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function findMovementMatch($load)
    {
        return Movement::where('pickup_address_id', $load->pickup_address_id)
        ->where('destination_address_id', $load->delivery_address_id)
        ->where('destination_start', Carbon::parse($load->delivery_start)->toDateTimeString())
        ->where('destination_end', Carbon::parse($load->delivery_end)->toDateTimeString())
        ->where('pickup_start', Carbon::parse($load->pickup_start)->toDateTimeString())
        ->where('pickup_end', Carbon::parse($load->pickup_end)->toDateTimeString())
        ->first();
    }
}
