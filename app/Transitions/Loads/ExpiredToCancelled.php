<?php

namespace App\Transitions\Loads;

use App\Models\Load;
use App\States\Load\Cancelled;
use Spatie\ModelStates\Transition;

class ExpiredToCancelled extends Transition
{
    private Load $load;

    public function __construct(Load $load)
    {
        $this->load = $load;
    }

    public function handle(): Load
    {
        $this->load->state = new Cancelled($this->load);
        $this->load->save();

        return $this->load;
    }
}
