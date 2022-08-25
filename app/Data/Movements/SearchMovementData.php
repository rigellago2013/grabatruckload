<?php

namespace App\Data\Movements;

use App\Http\Livewire\Movements\MovementsTableComponent;
use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

final class SearchMovementData extends DataTransferObject
{
    public string $sort;
    public string $searchTerm;
    public DateTime|null $pickupStart;
    public DateTime|null $destinationEnd;
    public array $pickup;
    public array $destination;


    public static function fromComponent(MovementsTableComponent $component): self
    {
        return new self($component->validate());
    }
}
