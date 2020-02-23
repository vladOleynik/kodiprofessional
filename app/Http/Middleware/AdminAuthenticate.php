<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        $auth = Auth::guard($guard);        

        //dd($auth->user());
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return redirect()->guest('login');
                //return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        if ((int)$auth->user()->role_id !== 1) {
            return response('Access denied.', 401);
        }

        return $next($request);
    }

}
