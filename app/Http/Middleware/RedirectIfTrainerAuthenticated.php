<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfTrainerAuthenticated
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
        $user = Auth::guard('trainer')->user();

        if ($user) {
            return redirect()->route('app.trainers.dashboard');
        }

        return $next($request);
    }
}
