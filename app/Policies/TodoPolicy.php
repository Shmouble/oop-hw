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
        $result = $user->id === $todo->user_id ? true : abort(422);
        return $result;
    }

    public function delete(User $user, Todo $todo)
    {
        $result = $user->id === $todo->user_id ? true : abort(422);
        return $result;
    }
}
