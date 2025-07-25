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
    public function handle(Request $request, Closure $next,$role): Response
    {
        if (auth()->check() && auth()->user()->role !== $role) {
            Auth::logout();
            return redirect('/login')->withErrors([
                'email' => 'You not Have Access',
            ]);
        }
        return $next($request);
    
    }
}
