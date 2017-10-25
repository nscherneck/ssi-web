<?php

namespace App\Policies;

use App\User;
use App\System;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the system.
     *
     * @param  \App\User  $user
     * @param  \App\System  $system
     * @return mixed
     */
    public function view(User $user, System $system)
    {
        return true;
    }

    /**
     * Determine whether the user can create systems.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the system.
     *
     * @param  \App\User  $user
     * @param  \App\System  $system
     * @return mixed
     */
    public function update(User $user, System $system)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the system.
     *
     * @param  \App\User  $user
     * @param  \App\System  $system
     * @return mixed
     */
    public function delete(User $user, System $system)
    {
        if ($user->id === 1 || $user->id === 7 || $user->id === 3) {
            return true;
        }
        return false;
    }
}
