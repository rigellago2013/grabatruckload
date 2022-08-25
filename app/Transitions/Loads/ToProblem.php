<?php

namespace App\Transitions\Loads;

use App\Models\Load;
use App\States\Load\Problem;
use Spatie\ModelStates\Transition;

class ToProblem extends Transition
{
    private Load $load;
    private string $message;

    public function __construct(Load $load, string $message)
    {
        $this->load = $load;
        $this->message = $message;
    }

    public function handle(): Load
    {
        $this->load->state = new Problem($this->load);
//        $this->load->errors = $this->message;

        // @todo save message somewhere

        $this->load->save();

        return $this->load;
    }
}
