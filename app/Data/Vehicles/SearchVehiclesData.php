<?php

namespace App\Data\Vehicles;

use App\Http\Livewire\Vehicles\VehiclesTableComponent;
use Spatie\DataTransferObject\DataTransferObject;

final class SearchVehiclesData extends DataTransferObject
{
    public string $searchTerm = '';
    public string $sort = '';
    public string $vehicleCategory = '';

    public static function fromComponent(VehiclesTableComponent $component): self
    {
        return new self($component->validate());
    }
}
