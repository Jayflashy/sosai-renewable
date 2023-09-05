<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class User
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
        if (auth()->check() && auth()->user()->status != 1) {

            $redirect_to = "";
            if(auth()->user()->user_role == 'admin' || auth()->user()->user_role == 'staff'){
                $redirect_to = "admin.login";
            }else{
                $redirect_to = "login";
            }

            auth()->logout();

            $message = "Your account has been deleted or doesnt exist.";
            // Create custom message later

            return redirect()->route($redirect_to)->withEmodal($message)->withErrors($message);

        }
        if (auth()->check()){
            if(auth()->user()->user_role == 'admin' || auth()->user()->user_role == 'staff') {
                return redirect()->route('admin.index');
            }else if(auth()->user()->user_role == 'agent') {
                return redirect()->route('agent.index');
            }else if(auth()->user()->user_role == 'user') {
                return $next($request);
            }
            else{
                return redirect()->route('index');
            }
        }
        else{
            session(['link' => url()->current()]);
            return redirect()->route('login');
        }
    }
}
