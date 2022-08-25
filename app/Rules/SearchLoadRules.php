<?php

namespace App\Rules;

trait SearchLoadRules
{
    public function rules(): array
    {
        return [
            'dateStart' => 'nullable|date',
            'dateEnd' => 'nullable|date',
            'loadType' => 'nullable|string',
            'deliveryRegion' => 'nullable|array',
            'pickupRegion' => 'nullable|array',
            'statuses' => 'nullable|array',
            'sort' => 'nullable|string',
            'searchTerm' => 'nullable|string',
        ];
    }
}
