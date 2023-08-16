<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class LastSeekerActivity
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
        if (Auth::guard('seeker')->check()){
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('seeker_is_online-' . Auth::guard('seeker')->user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}
