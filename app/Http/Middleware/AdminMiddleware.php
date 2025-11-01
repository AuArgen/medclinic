<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        return response(auth());
        if (!auth()->check() || auth()->user()->role !== 'admin') {
//            $role = auth()->check() ? auth()->user()->role : 'Guest';
            abort(403, 'Unauthorized. Your role is: ' . $role);
        }
        return $next($request);
    }
}
