<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user is an admin
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // If the user is not an admin, return a 403 Forbidden response
        return response()->json([
            'message' => 'Access denied: You must have admin privileges to perform this action.'
        ], 403);
    }
}
