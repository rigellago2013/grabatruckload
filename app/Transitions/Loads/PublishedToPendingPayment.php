<?php

namespace App\Transitions\Loads;

use App\Models\Load;
use App\States\Load\PendingPayment;
use Spatie\ModelStates\Transition;

class PublishedToPendingPayment extends Transition
{
    private Load $load;

    public function __construct(Load $load)
    {
        $this->load = $load;
    }

    public function handle(): Load
    {
        $this->load->state = new PendingPayment($this->load);
        $this->load->save();

        // @todo send notification to top up wallet
        // @todo create pending payment for amount

        return $this->load;
    }
}
