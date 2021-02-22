<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Activity::create([
                    'user_id' => Auth::user()->id,
                    'activity' => 'Masuk dengan akun exova',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'availability' => (Auth::user()->notif->aktivitas == 1) ? 1 : 0,
                ]);
                return redirect()->intended();
            }
        }

        return $next($request);
    }
}
