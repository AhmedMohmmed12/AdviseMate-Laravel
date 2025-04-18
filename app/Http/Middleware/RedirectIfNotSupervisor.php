<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotSupervisor
{
    /**
     * Handle an incoming request.
     * Only allow super_admin users to access supervisor routes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and has the super_admin role
        if (!Auth::check() || !Auth::user()->hasRole('super_admin')) {
            // If user is authenticated but not super_admin, redirect to their respective dashboard
            if (Auth::check()) {
                if (Auth::user()->hasRole('advisor')) {
                    return redirect()->route('advisor.dashboard')->with('error', 'You do not have access to the supervisor area.');
                } elseif (Auth::user()->hasRole('student')) {
                    return redirect()->route('student.dashboard')->with('error', 'You do not have access to the supervisor area.');
                }
            }
            
            // If user is not authenticated, redirect to login
            return redirect()->route('login');
        }

        return $next($request);
    }
} 