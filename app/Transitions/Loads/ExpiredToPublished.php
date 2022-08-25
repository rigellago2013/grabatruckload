<?php

namespace App\Transitions\Loads;

use App\Models\Load;
use App\States\Load\Published;
use Spatie\ModelStates\Transition;

class ExpiredToPublished extends Transition
{
    private Load $load;

    public function __construct(Load $load)
    {
        $this->load = $load;
    }

    public function handle(): Load
    {
        $this->load->state = new Published($this->load);

        // @todo The only attributes that can be saved are the dates and times

        $this->load->save();

        return $this->load;
    }
}
