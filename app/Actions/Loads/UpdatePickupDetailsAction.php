<?php

namespace App\Actions\Loads;

use App\Data\Loads\PickupDetailsData;
use App\Models\Address;
use App\Models\Load;

class UpdatePickupDetailsAction
{
    public function execute(PickupDetailsData $data): void
    {
        $address = Address::updateOrCreate(
            [
                'id' => $data->load->pickup_address_id,
            ],
            [
                'street_address' => $data->street,
                'city' => $data->town,
                'postcode' => $data->postCode,
            ]
        );

        Load::updateOrCreate(
            [
                'id' => $data->load->id,
            ],
            [
                'phone_number' => $data->phoneNumber,
                'email_to_notify' => $data->email,
                'instructions' => $data->instructions,
                'pickup_equipments' => $data->pickUpEquipments,
                'company' => $data->company,
                'contact_name' => $data->contactName,
                'pickup_start' => $data->pickupStart,
                'pickup_end' => $data->pickupEnd,
                'pickup_address_id' => $address->id,
                'extra_emails' => $data->extraEmails,
            ]
        );
    }
}
