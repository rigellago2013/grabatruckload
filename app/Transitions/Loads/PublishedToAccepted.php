<?php

namespace App\Transitions\Loads;

use App\Actions\GetAccountBalance;
use App\Models\Load;
use App\States\Load\Accepted;
use Spatie\ModelStates\Transition;

class PublishedToAccepted extends Transition
{
    private Load $load;

    public function __construct(Load $load)
    {
        $this->load = $load;
    }

    public function handle(): Load
    {
//        if (app(GetAccountBalance::class)->execute($this->load->owner) <= 0) {
//            // pending payment process begins
//            // load goes into pending payment status
//            return $this->load;
//        }

        $this->load->state = new Accepted($this->load);
        $this->load->save();

        return $this->load;
    }
}
