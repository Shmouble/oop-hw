<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticationCheck
{
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            return abort(404);
        }

        return $next($request);
    }
}
