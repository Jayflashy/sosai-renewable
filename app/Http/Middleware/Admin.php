<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Admin
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
        if (auth()->check()) { 
            if(Auth::user()->user_role == 'admin' || Auth::user()->user_role == 'staff') {
                return $next($request);
            }else{
                return redirect()->route('index');
            }
        }
        else{
            session(['link' => url()->current()]);
            return redirect()->route('admin.login');
        }
    }
}
