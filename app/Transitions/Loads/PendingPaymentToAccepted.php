<?php

namespace App\Transitions\Loads;

use App\Models\Load;
use App\States\Load\Accepted;
use Spatie\ModelStates\Transition;

class PendingPaymentToAccepted extends Transition
{
    private Load $load;

    public function __construct(Load $load)
    {
        $this->load = $load;
    }

    public function handle(): Load
    {
        $this->load->state = new Accepted($this->load);

        $this->load->save();

        return $this->load;
    }
}
