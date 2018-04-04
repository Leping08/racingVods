<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;

class ApiCsrfToken
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws TokenMismatchException
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('X-CSRF-TOKEN');

        if(is_string($token) && (strlen($token) === 40)){
            return $next($request);
        }

        throw new TokenMismatchException;
    }
}
