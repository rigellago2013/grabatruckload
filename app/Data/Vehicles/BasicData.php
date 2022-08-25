<?php

namespace App\Data\Vehicles;

use App\Http\Livewire\Vehicles\VehiclesCreateComponent;
use Spatie\DataTransferObject\DataTransferObject;

final class BasicData extends DataTransferObject
{
    public string $loadType;
    public string $vehicleType;
    public string $category;
    public string $plateNumber;
    public string|null $notes;
    public int|null $deckLength;

    // or of the vehicle
    /** @var array<UploadedFile|TemporaryUploadedFile>|null */
    public array|null $or;

    // cr related to the vehicle
    /** @var array<UploadedFile|TemporaryUploadedFile>|null */
    public array|null $cr;

    // cr related to the vehicle
    /** @var array<UploadedFile|TemporaryUploadedFile>|null */
    public array|null $truckPicture;

    public string|null $trailerType;
    public string|null $trailerOption;
    public string|null $truckCategory;
    public string|null $truckType;
    // public int $volume;
    public int|null $weight;

    public static function fromComponent(VehiclesCreateComponent $component): self
    {
        return new self($component->validate());
    }
}
