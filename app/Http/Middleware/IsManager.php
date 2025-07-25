<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class IsManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('staff')->user() && Auth::guard('staff')->user()->type == 'manager') {
            return $next($request);
        } else {
            Alert::error('Acces interzis', 'Nu aveți dreptul să accesați această secțiune')->persistent(true, false);
        }

        return back()->with('error', 'Nu aveți dreptul să accesați această secțiune');
    }
}
