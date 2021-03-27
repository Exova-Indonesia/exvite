<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Studio;

class StudioComplete
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
        $seller = Studio::where('user_id', auth()->user()->id)->first();
        if($seller->is_complete == 1) {
            redirect('/mystudio/dashboard');
        } else {
            redirect('/studio/getting-started');
        }
        return $next($request);
    }
}
