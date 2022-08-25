<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Models\Offer;
use App\States\Load\Accepted;

class AcceptOffer extends BaseAction
{
    /**
     * @param Offer $offer
     */
    public function execute(Offer $offer): void
    {
        $this->authorise();

        \DB::transaction(function () use ($offer): void {
            $offer->state->transitionTo(\App\States\Offer\Accepted::class);
            $offer->offerLoad->state->transitionTo(Accepted::class);

            $offer->save();
            $offer->offerLoad->save();
        });
    }
}
