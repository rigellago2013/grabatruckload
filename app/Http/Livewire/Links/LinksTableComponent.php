<?php

namespace App\Http\Livewire\Links;

use App\Actions\Links\SearchLink;
use App\Data\Links\SearchLinkData;
use App\Enums\LinksSortDataEnum;
use App\Models\Address;
use App\Rules\SearchLinksRules;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

class LinksTableComponent extends Component
{
    use WithPagination;
    use SearchLinksRules;

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
    protected $queryString = ['searchTerm', 'dateStartString', 'dateEndString', 'loadType', 'deliveryRegion', 'pickupRegion','sort'];

    public function render()
    {
        return view('livewire.links.links-table-component', [
            'links' => $this->searchLinks(),
            'sortData' => LinksSortDataEnum::labels(),
            'regions' => $this->getRegions(),
        ]);
    }

    public function searchLinks()
    {
        if ($this->dateStartString != '' && $this->dateEndString != '') {
            $this->dateStart = new DateTime($this->dateStartString);
            $this->dateEnd = new DateTime($this->dateEndString);
        }

        $this->validate($this->rules());
        $data = SearchLinkData::fromComponent($this);

        return app(SearchLink::class)->execute($data);
    }


    private function getRegions()
    {
        return Address::select('province')
            ->distinct()
            ->orderBy('province')
            ->get()
            ->values();
    }

    public function clearAll()
    {
        $this->dateStartString = '';
        $this->dateEndString = '';
        $this->searchTerm = '';
        $this->sort = '';
        $this->loadType = '';
        $this->statusString = '';
        $this->deliveryRegion = [];
        $this->pickupRegion = [];
        $this->statuses = [];

        return redirect('/links');
    }
}
