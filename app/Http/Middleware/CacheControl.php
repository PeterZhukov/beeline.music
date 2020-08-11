<?php
namespace App\Http\Middleware;

use Closure;

class CacheControl
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->setPrivate();
        $response->mustRevalidate();

        return $response;
    }
}
