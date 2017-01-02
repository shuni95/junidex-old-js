<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class TrainerAuthenticate
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

        if (is_null($user) || !$user->trainer) {
            return redirect()->route('app.trainers.login.showForm');
        }

        return $next($request);
    }
}
