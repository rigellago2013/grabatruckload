<?php

namespace App\Http\Livewire\Movements;

use App\Actions\Movements\SearchMovementsAction;
use App\Data\Movements\SearchMovementData;
use App\Enums\MovementSortDataEnum;
use App\Models\Address;
use App\Rules\SearchMovementRules;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class MovementsTableComponent extends Component
{
    use WithPagination;
    use SearchMovementRules;

    public string $searchTerm = '';
    public string $pickupStartString = '';
    public string $destinationEndString = '';
    public string $sort = '';
    public DateTime $pickupStart;
    public DateTime $destinationEnd;
    public array $pickup = [];
    public array $destination = [];
    protected $queryString = ['searchTerm','sort', 'pickupStartString','destinationEndString'];

    public function render()
    {
        return view('livewire.movements.movements-table-component', [
            'movements' => $this->searchMovement(),
            'sortData' => MovementSortDataEnum::labels(),
            'pickupAddresses' => Address::distinct('province')->get(),
            'destinationAddresses' => Address::distinct('province')->get(),
        ]);
    }

    public function searchMovement()
    {
        if ($this->pickupStartString != '' && $this->destinationEndString != '') {
            $this->pickupStart = Carbon::parse($this->pickupStartString);
            $this->destinationEnd = Carbon::parse($this->destinationEndString);
        }
        $this->validate($this->rules());
        $data = SearchMovementData::fromComponent($this);

        return app(SearchMovementsAction::class)->execute($data);
    }

    public function clearAll()
    {
        $this->pickupStartString = '';
        $this->destinationEndString = '';
        $this->searchTerm = '';
        $this->sort = '';
        $this->pickup = [];
        $this->destination = [];

        return redirect('/movements');
    }
}
