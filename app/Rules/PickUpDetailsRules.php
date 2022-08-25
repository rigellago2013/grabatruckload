<?php

namespace App\Rules;

trait PickUpDetailsRules
{
    public function rules(): array
    {
        return [
            'company' => 'required|string',
            'contactName' => 'required|string',
            'phoneNumber' => 'nullable|string|min:7',
            'email' => 'required|string',
            'extraEmails' => 'nullable|array',
            'pickupStart' => 'required|date|before:pickupEnd',
            'pickupEnd' => 'required|date|after:pickupStart',
            'street' => 'required|string',
            'town' => 'required|string',
            'postCode' => 'required|string',
            'instructions' => 'string',
            'pickUpEquipments' => 'array',
        ];
    }
}
