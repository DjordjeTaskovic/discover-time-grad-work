<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //Logged in user can not access the block of routes surounded by this middleware
        if(!$request->session()->has("user")){
            return $next($request);
        }
    
        return redirect()->route("home")->with('loginmessage',
         'Only administrator can access this page.');
       
    }
}
