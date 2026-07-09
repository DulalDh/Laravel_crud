<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddultMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if($request->age< 18){
        //     return response()->json([
        //         'error' => 'You are not addult...'
        //     ], 403);
        // }
        return $next($request);
    }
}
