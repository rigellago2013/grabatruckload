<?php

namespace App\States\Load;

use App\Transitions\Loads\AcceptedToCancelled;
use App\Transitions\Loads\AcceptedToInTransit;
use App\Transitions\Loads\DraftToPending;
use App\Transitions\Loads\ExpiredToCancelled;
use App\Transitions\Loads\ExpiredToPublished;
use App\Transitions\Loads\InTransitToComplete;
use App\Transitions\Loads\PendingPaymentToAccepted;
use App\Transitions\Loads\PendingToCancelled;
use App\Transitions\Loads\PendingToPublished;
use App\Transitions\Loads\PublishedToAccepted;
use App\Transitions\Loads\PublishedToCancelled;
use App\Transitions\Loads\PublishedToExpired;
use App\Transitions\Loads\PublishedToPendingPayment;
use App\Transitions\Loads\ToProblem;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class LoadState extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Draft::class)
            ->allowTransition(Accepted::class, Cancelled::class, AcceptedToCancelled::class)
            ->allowTransition(Accepted::class, InTransit::class, AcceptedToInTransit::class)
            ->allowTransition(Draft::class, Pending::class, DraftToPending::class)
            ->allowTransition(Expired::class, Cancelled::class, ExpiredToCancelled::class)
            ->allowTransition(Expired::class, Published::class, ExpiredToPublished::class)
            ->allowTransition(InTransit::class, Complete::class, InTransitToComplete::class)
            ->allowTransition(Pending::class, Published::class, PendingToPublished::class)
            ->allowTransition(Pending::class, Cancelled::class, PendingToCancelled::class)
            ->allowTransition(PendingPayment::class, Accepted::class, PendingPaymentToAccepted::class)
            ->allowTransition(Published::class, Accepted::class, PublishedToAccepted::class)
            ->allowTransition(Published::class, Cancelled::class, PublishedToCancelled::class)
            ->allowTransition(Published::class, Expired::class, PublishedToExpired::class)
            ->allowTransition(Published::class, PendingPayment::class, PublishedToPendingPayment::class)
            ->allowTransition(
                [
                    Accepted::class,
                    Cancelled::class,
                    Expired::class,
                    InTransit::class,
                    Pending::class,
                    PendingPayment::class,
                    Published::class,
                ],
                Problem::class,
                ToProblem::class
            );
    }
}
