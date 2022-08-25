<?php

namespace App\Rules;

trait SearchVehicleRules
{
    public function rules(): array
    {
        return [
            'loadType' => 'nullable|string',
            'vehicleCategory' => 'nullable|string',
            'searchTerm' => 'nullable|string',
            'sort' => 'nullable|string',
        ];
    }
}
