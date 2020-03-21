<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserCheck
{
    public function handle($request, Closure $next)
    {
        if($request->route('id') != Auth::user()->id)
        {
            return abort(404);
        }

        return $next($request);
    }
}
