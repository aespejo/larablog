<?php

namespace App\Http\Middleware;

use Auth;
use Session;
use Closure;

class AdminCheck
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
        if(!Auth::user()->admin) {
            Session::flash('info', "You don't have permission to perform the action");
            return redirect()->back();
        }

        return $next($request);
    }
}
