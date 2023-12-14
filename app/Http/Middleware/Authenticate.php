<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        
        if(auth('api')->user() && auth('api')->user()->is_active == 1){
            return $next($request);
        }
        return  response()->json([
            "success" =>false,
            "status" => 403,
            "data" => [],
            "message" => __('customer.login.unauthorized'),
        ], 403);
    }
}
