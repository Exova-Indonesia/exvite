<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Membership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->subscription == 0) {
            return redirect()->back();
        }
        return $next($request);
    }
}
