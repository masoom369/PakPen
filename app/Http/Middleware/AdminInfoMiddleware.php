<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AdminInfoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Fetch the admin user data
        $admin = User::where('actual_usertype', 'admin')->first();

        // Share admin data with all views
        View::share('admin', $admin);

        return $next($request);
    }
}
