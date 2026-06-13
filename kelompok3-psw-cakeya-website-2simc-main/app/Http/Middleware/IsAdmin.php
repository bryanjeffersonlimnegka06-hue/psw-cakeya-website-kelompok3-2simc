<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'Please log in first.');
        }

        // Check if user is admin (assuming admin_role or is_admin field in users table)
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized access. You do not have admin permissions.');
        }

        return $next($request);
    }
}
