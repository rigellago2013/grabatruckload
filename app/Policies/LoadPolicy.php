<?php

namespace App\Policies;

use App\Models\Load;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('load:read');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Load $load)
    {
        return $user->hasPermissionTo('load:read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('load:create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Load $load)
    {
        if ($user->hasRole('admin') || $user->hasRole('customer-service')) {
            return $user->hasPermissionTo('load:update');
        }

        if ($load->user_id === $user->id) {
            return $user->hasPermissionTo('load:update');
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Load $load)
    {
        return $user->hasPermissionTo('load:delete', $load);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Load $load)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Load $load)
    {
        return false;
    }

    // State changes
    public function accept(User $user, Load $load): void
    {
    }

    /**
     * @param User $user
     * @param Load $load
     * @return bool
     */
    public function publish(User $user, Load $load)
    {
        return $user->hasPermissionTo('load:publish');
    }
}
