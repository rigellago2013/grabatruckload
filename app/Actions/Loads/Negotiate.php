<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Models\Load;

class Negotiate extends BaseAction
{
    /**
     * @param Load $load
     */
    public function execute(Load $load): void
    {
        $this->authorise();
    }
}
