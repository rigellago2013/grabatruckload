<?php

namespace App\Transitions\Loads;

use App\Models\Load;
use App\States\Load\Complete;
use Spatie\ModelStates\Transition;

class InTransitToComplete extends Transition
{
    private Load $load;

    public function __construct(Load $load)
    {
        $this->load = $load;
    }

    public function handle(): Load
    {
        $this->load->state = new Complete($this->load);

        $this->load->save();

        return $this->load;
    }
}
