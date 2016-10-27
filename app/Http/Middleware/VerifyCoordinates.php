<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCoordinates
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
        if ($request->segment(3) == "0.0" || $request->segment(4) == "0.0")
        {
            return false;
        }
        return $next($request);
    }
}
