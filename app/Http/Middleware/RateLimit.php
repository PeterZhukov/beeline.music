<?php
namespace App\Http\Middleware;

use App\RateLimit\ConfigParser;
use App\RateLimit\RateLimiter;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class RateLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        /** @var ConfigParser $configParser */
        $configParser = app(ConfigParser::class);
        /** @var RateLimiter $rateLimiter */
        $rateLimiter = app(RateLimiter::class);
        $interval = $configParser->getConfigValueAsDateInterval();
        if ($interval){
            $accessCount = $configParser->getConfigCount();
            if (!is_null($accessCount)){
                $ip = $request->ip();
                if (!$rateLimiter->checkAccessCount($interval, $accessCount, $ip)){
                    throw new TooManyRequestsHttpException(null, 'Too many requests');
                }
            }
        }
        return $next($request);
    }
}
