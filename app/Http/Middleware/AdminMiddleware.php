<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        if($request->session()->has("user") && $request->session()->get('user')->admin_role){
            return $next($request);
        }
    
        return redirect()->route("home")->with('loginmessage',
         'Only administrator can access this page.');
       
    }
}
