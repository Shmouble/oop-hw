<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model\Todo' => 'App\Policies\TodoPolicy',
        'App\User' => 'App\Policies\UserPolicy',

    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
