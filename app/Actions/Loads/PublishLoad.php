<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Models\Load;
use App\States\Load\Published;

class PublishLoad extends BaseAction
{
    /**
     * @param Load $load
     */
    public function execute(Load $load): void
    {
        $this->authorise();

        $load->state->transitionTo(Published::class);
        $load->save();
    }
}
