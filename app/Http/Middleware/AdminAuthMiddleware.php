<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
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
        if(!$request->user()) {
            return redirect('/login');
        }
        if($request->user()->user_type_id == 1) {
            return $next($request);
        }

        //return redirect('/');
    }
}
