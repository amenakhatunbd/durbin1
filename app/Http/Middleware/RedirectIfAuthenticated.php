<?php

namespace App\Http\Middleware;

use App\SM\SM;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }
        
        if (Auth::guard($guard)->check()) {
            if (Session::has('cart_reg')) {
                if(Session::get('cart_reg')){
                    Session::forget('cart_reg');
                    return redirect('/cart');
                } else {
                    return redirect('/home');
                }
            } else {
                return redirect('/home');
            }    
        }

        return $next($request);
    }
}
