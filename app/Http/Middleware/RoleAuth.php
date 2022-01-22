<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 'user', $guard = null)
    {

        if (Auth::guard($guard)->check() && Auth::user()->role_type == $role) {

            return $next($request);
        }
        else{
            return redirect()->route('login');

        }

    }
}
