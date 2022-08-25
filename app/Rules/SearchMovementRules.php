<?php

namespace App\Rules;

trait SearchMovementRules
{
    public function rules(): array
    {
        return [
            'destinationEnd' => 'nullable|date|after:pickupStart',
            'pickupStart' => 'nullable|date|before:destinationEnd',
            'searchTerm' => 'nullable|string',
            'sort' => 'nullable|string',
            'pickup' => 'nullable|array',
            'destination' => 'nullable|array',
        ];
    }
}
