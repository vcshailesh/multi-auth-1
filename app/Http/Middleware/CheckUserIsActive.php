<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth()->guard('admin')->user()->status == 0) {
            Auth::guard('admin')->logout();
            return redirect(route('admin.auth.login'));
        }

        return $next($request);
    }
}
