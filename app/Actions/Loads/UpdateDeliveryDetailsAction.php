<?php

namespace App\Actions\Loads;

use App\Data\Loads\DeliveryDetailsData;
use App\Models\Address;
use App\Models\Load;

class UpdateDeliveryDetailsAction
{
    public function execute(DeliveryDetailsData $data): void
    {
        $address = Address::updateOrCreate(
            [
                'id' => $data->load->delivery_address_id,
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
                'delivery_equipments' => $data->deliveryEquipments,
                'company' => $data->company,
                'contact_name' => $data->contactName,
                'delivery_start' => $data->deliveryStart,
                'delivery_end' => $data->deliveryEnd,
                'delivery_address_id' => $address->id,
                'extra_emails' => $data->extraEmails,
            ]
        );
    }
}
