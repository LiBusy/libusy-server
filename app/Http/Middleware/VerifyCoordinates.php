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
        dd($request->segment(1));
        return $next($request);
    }
}
