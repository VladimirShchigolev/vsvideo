<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NotBlockedUserMiddleware
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
        if (Auth::check() && auth()->user()->isBlocked)
        {
            return redirect('home')->withErrors(__('messages.This_Account_is_blocked_by_the_site_administration'));
        }
        return $next($request);
    }
}
