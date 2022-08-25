<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Models\Load;
use App\Notifications\LoadDelivered;
use App\States\Load\Complete;

class DeliverLoad extends BaseAction
{
    /**
     * @param Load $load
     */
    public function execute(Load $load): void
    {
        $this->authorise();

        $load->state->transitionTo(Complete::class);
        $load->save();

        event(new LoadDelivered($load));
    }
}
