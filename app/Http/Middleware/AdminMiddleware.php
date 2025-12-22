<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Ensure the user is authenticated and has admin or editor role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        if (!$user->hasRole('admin') && !$user->hasRole('editor')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
            abort(403, 'You do not have access to the admin panel.');
        }

        return $next($request);
    }
}
