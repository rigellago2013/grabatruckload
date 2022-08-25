<?php

namespace App\Http\Livewire\Loads;

use App\Actions\Loads\SearchLoad;
use App\Data\Loads\SearchLoadData;
use App\Enums\LoadSortDataEnum;
use App\Enums\LoadStatusEnum;
use App\Models\Address;
use App\Models\Load;
use App\Rules\SearchLoadRules;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class LoadsTableComponent extends Component
{
    use WithPagination;
    use SearchLoadRules;

    public string $dateStartString = '';
    public string $dateEndString = '';
    public string $searchTerm = '';
    public string $sort = '';
    public string $loadType = '';
    public string $statusString = '';
    public array $deliveryRegion = [];
    public array $pickupRegion = [];
    public array $statuses = [];
    public DateTime $dateStart;
    public DateTime $dateEnd;
    protected $queryString = ['searchTerm', 'dateStartString', 'dateEndString', 'loadType', 'deliveryRegion', 'pickupRegion', 'statuses', 'sort'];


    public function render()
    {
        return view('livewire.loads.loads-table-component', [
            'loads' => $this->searchLoad(),
            'sortData' => LoadSortDataEnum::labels(),
            'regions' => $this->getRegions(),
            'statusData' => LoadStatusEnum::labels(),
        ]);
    }

    private function getRegions()
    {
        return Address::select('province')
            ->distinct()
            ->orderBy('province')
            ->get()
            ->values();
    }

    public function searchLoad()
    {
        if ($this->dateStartString != '' && $this->dateEndString != '') {
            $this->dateStart = Carbon::parse($this->dateStartString);
            $this->dateEnd = Carbon::parse($this->dateEndString);
        }

        $this->validate($this->rules());
        $data = SearchLoadData::fromComponent($this);

        return app(SearchLoad::class)->execute($data);
    }

    public function getAllLoads()
    {
        return Load::paginate(25);
    }

    public function clearAll()
    {
        $this->dateStartString = '';
        $this->dateEndString = '';
        $this->searchTerm = '';
        $this->sort = '';
        $this->loadType = '';
        $this->deliveryRegion = [];
        $this->pickupRegion = [];
        $this->statuses = [];

        return redirect('/loads');
    }
}
