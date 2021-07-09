<?php

namespace App\Http\Middleware;

use App\Events\UserActivityEvent;
use Closure;
use Illuminate\Http\Request;

class UserActivity
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
        /** Check Authenticated */
        if (auth()->check()) {
            event(new UserActivityEvent(auth()->user(), $request->ip()));
        }

        return $next($request);
    }
}
