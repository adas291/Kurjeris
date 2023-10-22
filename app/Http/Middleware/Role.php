<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle($request, Closure $next, $role)
    {
        if ($request->user() && $request->user()->user_role == $role) {
            return $next($request);
        }
        dd(request()->user()->user_role);
        abort(403); // Return a 403 Forbidden response if the user's role doesn't match
    }

}
