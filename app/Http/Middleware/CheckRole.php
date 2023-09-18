<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // $user = Auth::user();
        // $userRole = $user->employee->role_id;
        // $rolesContainUserRole = in_array($userRole, $roles);

        // if (Auth::check() && $user->employee && $rolesContainUserRole) {
        //     return $next($request);
        // }

        // return redirect()->route('Pending-Reports');
        return $next($request);
    }
}
