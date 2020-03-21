<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function updateUser(User $user)
    {
        if($user->role_id == 1)
        {
            return true;
        }
        else
        {
            return abort(422);
        }
    }

    public function deleteUser(User $user)
    {
        if($user->role_id == 1)
        {
            return true;
        }
        else
        {
            return abort(422);
        }
    }
}
