<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    	if(auth('api')->user() && auth('api')->user()->is_active == 1){
            return $next($request);
        }
        return  response()->json([
            "success" =>false,
            "status" => 403,
            "data" => [],
            "message" => 'Un Authinticated',
        ], 403);
        return $next($request);
    }
}
