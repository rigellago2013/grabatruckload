<?php

namespace App\Actions;

use App\Models\User;

class GetAccountBalance extends BaseAction
{
    public function execute(User $user): void
    {
        $this->authorise();
    }
}
