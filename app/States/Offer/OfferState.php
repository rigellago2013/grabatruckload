<?php

namespace App\States\Offer;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class OfferState extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Accepted::class)
            ->allowTransition(Pending::class, Rejected::class)
            ->allowTransition(Pending::class, Negotiated::class)
            ->allowTransition(Rejected::class, Negotiated::class)
            ;
    }
}
