<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Role;

class AdminCheck
{
    public function handle($request, Closure $next)
    {
        if(!$request->user()->isAdmin())
        {
            return abort(404);
        }

        return $next($request);
    }
}
