<?php

namespace App\Data\Links;

use App\Http\Livewire\Links\LinksTableComponent;
use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

final class SearchLinkData extends DataTransferObject
{
    public DateTime|null $dateStart;
    public DateTime|null $dateEnd;
    public string $loadType;
    public array $deliveryRegion;
    public array $pickupRegion;
    public string $sort;
    public string $searchTerm;

    public static function fromComponent(LinksTableComponent $component): self
    {
        return new self($component->validate());
    }
}
