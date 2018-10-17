<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(!empty(Auth::user())){
                if(Auth::user()->role == 'admin'){
                    return redirect('/dashboard');
                }else{
                    return redirect('/');
                }
            }else{
                return redirect('/');
            }

        }

        return $next($request);
    }
}
