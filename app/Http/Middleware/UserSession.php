<?php

namespace App\Http\Middleware;

use Closure;

class UserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('UserSession')) {
            // user value cannot be found in session
            $request->session()->flash('message', 'Invalid Session Data');
            return redirect(route('front.login'));
        }
        return $next($request);
    }
}
