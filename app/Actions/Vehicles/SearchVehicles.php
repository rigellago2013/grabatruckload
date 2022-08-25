<?php

namespace App\Actions\Vehicles;

use App\Data\Vehicles\SearchVehiclesData;
use App\Models\Vehicle;

class SearchVehicles
{
    public function execute(SearchVehiclesData $data)
    {
        $searchTerm = $data->searchTerm;
        $vehicleCategory = $data->vehicleCategory;
        $sort = $data->sort;

        return Vehicle::query()->when($searchTerm, function ($query, $searchTerm): void {
            $query->where('plate_number', 'LIKE', "%{$searchTerm}%");
        })
            ->when($vehicleCategory, function ($query, $vehicleCategory): void {
                $query->where('category', $vehicleCategory);
            })
            ->when($sort, function ($query, $sort): void {
                $query->orderBy($sort, 'desc');
            })
            ->paginate(25);
    }
}
