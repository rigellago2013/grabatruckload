<?php

namespace App\Rules;

trait DeliveryDetailsRules
{
    public function rules(): array
    {
        return [
            'company' => 'required|string',
            'contactName' => 'required|string',
            'phoneNumber' => 'nullable|string|min:7',
            'email' => 'required|string',
            'extraEmails' => 'nullable|array',
            'deliveryStart' => 'required|date|before:deliveryEnd',
            'deliveryEnd' => 'required|date|after:deliveryStart',
            'street' => 'required|string',
            'town' => 'required|string',
            'postCode' => 'required|string',
            'instructions' => 'string',
            'deliveryEquipments' => 'array',
        ];
    }
}
