<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AppSetupRegister
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
        $adminSet = User::where(['role' => User::USER_ROLE_ADMIN])->first();
        if ($adminSet) {
            return redirect(route('login'));
        }

        return $next($request);
    }
}
