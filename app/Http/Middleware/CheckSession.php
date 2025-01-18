<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSession
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the session contains 'user_id'
        if (!session()->has('user_id')) {
            // If not, redirect to the login page
            return redirect()->route('login');
        }

        // Continue with the request if the session is valid
        return $next($request);
    }
}
