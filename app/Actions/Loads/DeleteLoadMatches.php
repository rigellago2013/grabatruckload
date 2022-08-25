<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Models\Load;

class DeleteLoadMatches extends BaseAction
{
    public function execute(Load $load): void
    {
        $this->authorise();
    }
}
