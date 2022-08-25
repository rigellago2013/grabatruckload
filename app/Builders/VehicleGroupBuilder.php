<?php

namespace App\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass
 * @extends Builder<TModelClass>
 */
class VehicleGroupBuilder extends Builder
{
    public function ownedBy(User $owner)
    {
        return $this->where('user_id', $owner->id);
    }
}
