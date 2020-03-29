<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function getUsers(User $user)
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

    public function deleteUser(User $user, User $userToDeletion)
    {
        if(($user->role_id == 1) && ($user->id != $userToDeletion->id))
        {
            return true;
        }
        else
        {
            return abort(422);
        }
    }
}
