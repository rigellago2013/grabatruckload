<?php

namespace App\Actions;

use App\Models\User;

abstract class BaseAction
{
    private ?User $user;

    public function actingAs(User $user): void
    {
        $this->user = $user;
    }

    public function authorise(): void
    {
    }
}
