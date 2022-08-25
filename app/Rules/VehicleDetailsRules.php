<?php

namespace App\Rules;

trait VehicleDetailsRules
{
    public function rules(): array
    {
        return [
            'loadType' => 'required|string',
            'category' => 'required|string',
            'plateNumber' => 'required|string|min:7',
            'notes' => 'nullable|string',
            'deckLength' => 'nullable|numeric|integer',
            'or.*' => 'nullable|image|max:10000',
            'cr.*' => 'nullable|image|max:10000',
            'truckPicture.*' => 'nullable|image|max:10000',
            'trailerType' => 'nullable|string',
            'trailerOption' => 'nullable|string',
            // 'volume' => 'nullable|numeric|integer|min:1',
            'weight' => 'nullable|numeric|integer',
            'vehicleType' => 'nullable|string',
            'truckType' => 'nullable|string',
            'truckCategory' => 'nullable|string',
        ];
    }
}
