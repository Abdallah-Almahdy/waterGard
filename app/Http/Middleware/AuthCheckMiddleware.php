<?php

namespace App\Http\Middleware;

use App\Models\Region;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->guard('sanctum')->user();
        $regionId = $request->route('government_id');


        // Check if the region with the given ID belongs to the user
        $region = Region::where('id', $regionId)->where('user_id', $user->id)->first();

        if (!$region) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        return $next($request);
    }
}
