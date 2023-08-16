<?php

namespace App\Http\Middleware;

use App\Traits\TrackRecruiter;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRecruiter
{
    use TrackRecruiter;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('recruiter')->check()){

            $notification = swal_alert_message_error("Please Login to continue");
            return redirect('recruiter/login')->with($notification);
        }else{
            $visitor = \Tracker::currentSession();
//            if($visitor->user_id == null){
                $visitor->user_id = Auth::guard('recruiter')->user()->id;
                $visitor->is_seeker = 0;
                $visitor->save();
//            }
        }
//        dd($visitor);
//        $this->trackerRecruiter();

        return $next($request);
    }
}
