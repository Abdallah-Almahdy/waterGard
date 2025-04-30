<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Create the response
        $response = $next($request);

        // Check if the current request path is either api/* or sanctum/csrf-cookie
        if ($request->is('api/*') || $request->is('sanctum/csrf-cookie')) {
            $response->headers->set('Access-Control-Allow-Origin', 'http://localhost'); // Replace with your frontend URL
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Max-Age', '3600');  // Cache the CORS preflight response for 1 hour

            // Handle OPTIONS preflight request
            if ($request->getMethod() == 'OPTIONS') {
                return response('', 200, $response->headers->all());
            }
        }

        return $response;
    }
}
