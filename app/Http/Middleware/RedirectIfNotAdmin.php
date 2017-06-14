<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class RedirectIfNotAdmin
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
        if ($request->user()->role == User::USER_ROLE_EMPLOYEE) {
            return redirect('/employee');
        }

        if ($request->user()->role != User::USER_ROLE_ADMIN) {
            return redirect('/');
        }

        return $next($request);
    }
}
