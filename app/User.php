<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        $result = $this->getRole() == 'admin' ? true : false;
        return $result;
    }

    public function getRole()
    {
        $userRole = Role::where('id', $this->role_id)->get();
        $userRole = $userRole[0]->name;

        return $userRole;
    }
}
