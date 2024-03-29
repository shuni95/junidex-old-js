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
    public function handle($request, Closure $next, $guard)
    {
        if (Auth::guard($guard)->check()) {
            if ($guard == 'trainer') {
                return redirect()->route('app.trainers.dashboard');
            } elseif ($guard == 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
