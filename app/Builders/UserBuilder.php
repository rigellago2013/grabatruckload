<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass
 * @extends Builder<TModelClass>
 */
class UserBuilder extends Builder
{
    public function owner()
    {
        return $this->whereHas('roles', function ($builder) {
            return $builder->where('name', 'owner');
        });
    }

    public function customer()
    {
        return $this->whereHas('roles', function ($builder) {
            return $builder->where('name', 'customer');
        });
    }

    public function hasVehicles()
    {
        return $this->whereHas('vehicleGroups');
    }
}
