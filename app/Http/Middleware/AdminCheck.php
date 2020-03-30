<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Role;

class AdminCheck
{
    public function handle($request, Closure $next)
    {
        $userRole = Role::where('id', $request->user()->role_id)->get();
        $userRole = $userRole[0]->name;

        if($userRole != 'admin')
        {
            return abort(404);
        }

        return $next($request);
    }
}
