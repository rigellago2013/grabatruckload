<?php

namespace App\Actions\Links;

use App\Actions\BaseAction;
use App\Models\Link;
use App\Models\Load;
use App\Models\Movement;

class CreateLinkAction extends BaseAction
{
    /**
     * @param Load|null $load
     * @param Movement|null $movement
     */
    public function execute(?Load $load, ?Movement $movement)
    {
        if ($load !== null && $movement !== null) {
            return Link::create([
                'load_id' => $load->id,
                'movement_id' => $movement->id,
            ]);
        }

        return null;
    }
}
