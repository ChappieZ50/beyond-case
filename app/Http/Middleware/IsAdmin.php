<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsAdmin
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed|never
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        return abort(Response::HTTP_UNAUTHORIZED);
    }
}
