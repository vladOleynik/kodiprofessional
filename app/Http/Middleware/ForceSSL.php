<?php

namespace App\Http\Middleware;

use Closure;

class ForceSSL
{

    public function handle($request, Closure $next)
    {

        if (!$request->secure()&&config('env')=='production') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
