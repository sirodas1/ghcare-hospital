<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guards = null)
    {

        if ($guard == "doctor" && Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::DOCTOR);
        }
        if ($guard == "pharmacist" && Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::PHARMACIST);
        }
        if ($guard == "nurse" && Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::NURSE);
        }
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
