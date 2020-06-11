<?php
namespace App\Http\Middleware;

use App\lib\CovidApi;
use Closure;

class CovidAuth
{
    /**
     * This middleware check & generate x-access-token for API
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle($request, Closure $next)
    {
        if(!session()->has('api_auth_token'))
        {
            $authenticate = (new CovidApi)->apiAuthenticate();
            if($authenticate) return $next($request);
            else abort(403);
        }

        return $next($request);
    }
}
