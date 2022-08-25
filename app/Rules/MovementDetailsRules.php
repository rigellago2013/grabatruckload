<?php

namespace App\Rules;

trait MovementDetailsRules
{
    public function rules(): array
    {
        return [
            'vehicle' => 'required|string',
            'pickupAddress' => 'required|string',
            'pickupStart' => 'required|date|before:pickupEnd',
            'pickupEnd' => 'required|date|after:pickupStart',
            'destinationAddress' => 'required|string',
            'destinationStart' => 'required|date|before:destinationEnd',
            'destinationEnd' => 'required|date|after:destinationStart',
        ];
    }
}
