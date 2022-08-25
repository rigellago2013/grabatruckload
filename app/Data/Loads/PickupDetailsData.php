<?php

namespace App\Data\Loads;

use App\Http\Livewire\Loads\UpdatePickupDetailsComponent;
use App\Models\Load;
use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

class PickupDetailsData extends DataTransferObject
{
    public Load $load;
    // Name of company sending the load
    public string|null $company;

    // Name of contact sending the load if not the current user
    public string $contactName;

    public string|null $phoneNumber;

    // Email of the contact that is receiving the load
    public string $email;

    // These emails will also be notified
    public array $extraEmails;

    // The start of the pickup window
    public DateTime $pickupStart;

    // The end of the pickup window
    public DateTime $pickupEnd;

    // The street address
    public string $street;

    // The city address
    public string $town;

    // The zipcode address
    public string $postCode;

    // Instructions for the pickup
    public string $instructions;

    // Pickup Loading equipment to use
    public array $pickUpEquipments;

    public static function fromComponent(UpdatePickupDetailsComponent $component): self
    {
        return new self($component->validate() + ['load' => $component->load]);
    }
}
