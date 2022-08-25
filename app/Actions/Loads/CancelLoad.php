<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Models\Load;

class CancelLoad extends BaseAction
{
    /**
     * @param Load $load
     */
    public function execute(Load $load): void
    {
        $this->authorise();
    }
}
