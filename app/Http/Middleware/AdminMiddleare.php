<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleare
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
        if (Auth::guard()->user() == 'admin'){
            return $next($request);
        }
       return back();
    }
}
