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
        //333C949CDEEBAB5ED3C747AF3EBBE
        if ($request->query('key') != '333C949CDEEBAB5ED3C747AF3EBBE')
        {
            return redirect('/');
        }
        //dd($request->query());
        return $next($request);
    }
}
