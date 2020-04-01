<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function getUsers(User $user)
    {
        $result = $user->role_id == 1 ? true : abort(422);
        return $result;
    }

    public function updateUser(User $user)
    {
        $result = $user->role_id == 1 ? true : abort(422);
        return $result;
    }

    public function deleteUser(User $user, User $userToDeletion)
    {
        $result = ($user->role_id == 1) && ($user->id != $userToDeletion->id) ? true : abort(422);
        return $result;
    }
}
