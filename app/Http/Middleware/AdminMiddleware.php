<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if session has is_admin = true
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login')->with('error', 'You must be an admin to access this page.');
        }

        return $next($request);
    }
}
