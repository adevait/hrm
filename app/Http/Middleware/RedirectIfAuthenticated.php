<?php

namespace App\Http\Middleware;

use App\User;
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
            if (Auth::user()->role == User::USER_ROLE_EMPLOYEE) {
                return redirect()->to('/employee');
            } else if (Auth::user()->role == User::USER_ROLE_ADMIN) {
                return redirect()->to('/admin');
            }
        }

        return $next($request);
    }
}
