<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Admin
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
        // Check if user is logged in - check() is static method of Auth class
        if(Auth::check()){
            // Check if logged in user is an admin - user() is static method of Auth class
            // isAdmin() method is defined in user model
            if(Auth::user()->isAdmin()){
                // Move to next request of application
                return $next($request);
            }
        }
        // If user is not logged in - redirect
        return redirect("/");
    }
}
