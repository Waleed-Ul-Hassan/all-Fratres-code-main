<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LastRecruiterActivity
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
        if (Auth::guard('recruiter')->check()){
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('recruiter_is_online-' . Auth::guard('recruiter')->user()->id, true, $expiresAt);
        }

        return $next($request);
    }
}
