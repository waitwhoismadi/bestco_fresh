<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Installsetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config('web.name') == ''){
            return redirect('install');
        }
        else{
            return $next($request);
        }

    }
}
