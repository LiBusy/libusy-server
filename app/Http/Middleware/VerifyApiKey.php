<?php

namespace App\Http\Middleware;

use App\Contracts\LocationRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

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
            return redirect('/'); // TODO need to have some form of message
        }
        dd("HERE");
        return $next($request);
    }
}
