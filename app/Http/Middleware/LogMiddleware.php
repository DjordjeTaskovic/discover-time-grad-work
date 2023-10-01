<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogMiddleware
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
        //Only Logged in user can access the block of routes surounded by this middleware
        if($request->session()->has("user")){
            return $next($request);
        }
    
        return redirect()->route("loginpage")->with('errorMessage',
         'Only logged user can preform this action. Make sure that you sign up.');
       
    }
}
