<?php

namespace App\Data\Loads;

use App\Http\Livewire\Loads\LoadsTableComponent;
use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

final class SearchLoadData extends DataTransferObject
{
    public DateTime|null $dateStart;
    public DateTime|null $dateEnd;
    public string $loadType;
    public array $deliveryRegion;
    public array $pickupRegion;
    public array $statuses;
    public string $sort;
    public string $searchTerm;

    public static function fromComponent(LoadsTableComponent $component): self
    {
        return new self($component->validate());
    }
}
