<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotSupervisor
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('supervisor')->check()) {
            return redirect()->route('supervisor.login');
        }

        return $next($request);
    }
}
