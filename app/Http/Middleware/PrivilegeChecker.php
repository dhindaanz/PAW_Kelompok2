<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrivilegeChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('web')->user();

        if (!$user) {
            return to_route('login')->with('error', 'You must be logged in to access this page.');
        }

        if (!$user->is_admin) {
            return back()->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
