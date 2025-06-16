<?php

namespace App\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login')->with('error', 'Please login to access your account.');
        }

        $customer = Auth::guard('customer')->user();
        if (!$customer->isActive()) {
            Auth::guard('customer')->logout();
            return redirect()->route('customer.login')->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
} 