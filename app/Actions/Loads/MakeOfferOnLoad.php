<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Models\Load;
use App\Models\Offer;
use App\Models\User;
use App\Models\VehicleGroup;
use App\States\Load\Negotiating;
use App\States\Load\Published;
use App\States\Offer\Pending;
use Brick\Money\Money;

/**
 * This is for truck owners to make offers on Loads uploaded by customers
 */
class MakeOfferOnLoad extends BaseAction
{
    /**
     * @param Load $load The load that is having an offer made on it
     * @param User $offeror The user account making the offer
     * @param Money $money The amount that the owner is willing to transport the load for
     * @param ?VehicleGroup $vehicleGroup
     * @return Offer
     */
    public function execute(
        Load $load,
        User $offeror,
        Money $money,
        ?VehicleGroup $vehicleGroup,
        ?Offer $inResponseTo
    ): Offer {
        $this->authorise();

        if (false === $load->state->equals(Published::$name, Negotiating::$name)) {
            // @todo throw exception, can't make an offer on non-published/negotiating loads
        }

        // @todo is the offer less than an existing offer? If it's coming from an owner it has to be higher
        // if it's coming from the customer it has to be lesser

        return Offer::create([
            'state' => Pending::$name,
            'load_id' => $load->id,
            'user_id' => $offeror->id,
            'vehicle_group_id' => $vehicleGroup->id ?? null,
            'currency_code' => $money->getCurrency()->getCurrencyCode(),
            'offer_amount' => $money->getMinorAmount(),
            'in_response_to' => $inResponseTo->id ?? null,
        ]);
    }
}
