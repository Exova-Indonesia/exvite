<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CartSession
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
        $cart = $request->session()->get('cart_shopping');
        if(empty($cart)) {
            return redirect('/');
        }

        return $next($request);
    }
}
