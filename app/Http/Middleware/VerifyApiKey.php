<?php

namespace App\Http\Middleware;

use Closure;

class VerifyApiKey
{
    /**
     * We only have one API key, this is a
     * shitty place to put this,
     * but it will work.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->query('key') != '333C949CDEEBAB5ED3C747AF3EBBE')
        {
            return redirect('/');
        }
        return $next($request);
    }
}
