<?php

namespace App\Data\Movements;

use App\Http\Livewire\Movements\CreateMovementComponent;
use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

final class BasicData extends DataTransferObject
{
    public string $vehicle;
    public string $pickupAddress;
    public string $destinationAddress;
    public DateTime $destinationStart;
    public DateTime $destinationEnd;
    public DateTime $pickupStart;
    public DateTime $pickupEnd;

    public static function fromComponent(CreateMovementComponent $component): self
    {
        return new self($component->validate());
    }
}
