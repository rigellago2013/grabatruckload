<?php

namespace App\Data\Loads;

use App\Http\Livewire\Loads\UpdateDeliveryDetailsComponent;
use App\Models\Load;
use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

class DeliveryDetailsData extends DataTransferObject
{
    public Load $load;

    // Name of company being delivered to
    public string|null $company;

    // Name of contact being delivered to
    public string $contactName;

    public string|null $phoneNumber;

    // Email of the contact that is receiving the load
    public string $email;

    // These emails will also be notified
    public array|null $extraEmails;

    // The start of the delivery window
    public DateTime $deliveryStart;

    // The end of the delivery window
    public DateTime $deliveryEnd;

    // The street address
    public string $street;

    public string $town;

    public string $postCode;

    // Any extra instructions for the driver
    public string $instructions;

    // Delivery Loading equipment to use
    public array $deliveryEquipments;

    public static function fromComponent(UpdateDeliveryDetailsComponent $component): self
    {
        return new self($component->validate() + ['load' => $component->load ]);
    }
}
