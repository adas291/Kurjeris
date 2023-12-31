<?php

namespace App\Http\Middleware;

use App\Roles;
use Closure;
use Illuminate\Contracts\Session\Session;
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

            $roles = [1 => "Klientas", 2 => 'Operatorius', 3 => 'Administratorius'];

            session(['role_name' => $roles[auth()->user()->user_role]]);
            return $next($request);
        }
        dd(request()->user()->user_role);
        abort(403); // Return a 403 Forbidden response if the user's role doesn't match
    }

}
