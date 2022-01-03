<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        $guardHome = [
            'admin' => '/admin/dashboard',
            'student' => '/student/dashboard',
            'lecturer' => '/lecturer/dashboard',
        ];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($guardHome[$guard]);
            }
        }

        return $next($request);
    }
}
