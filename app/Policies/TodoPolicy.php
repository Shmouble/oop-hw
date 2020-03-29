<?php

namespace App\Policies;

use App\User;
use App\Model\Todo;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Todo $todo)
    {
        if($user->id === $todo->user_id)
        {
            return true;
        }
        else
        {
            return abort(422);
        }
    }

    public function delete(User $user, Todo $todo)
    {
        if($user->id === $todo->user_id)
        {
            return true;
        }
        else
        {
            return abort(422);
        }
    }
}
