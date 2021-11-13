<?php

namespace App\Http\Middleware;

use Closure;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->key != "pemiraunila2021") {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized!',
            ], 401);
        }
        return $next($request);
    }
}
