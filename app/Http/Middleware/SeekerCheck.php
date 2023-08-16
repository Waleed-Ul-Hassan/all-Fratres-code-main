<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use PragmaRX\Tracker;

class SeekerCheck
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

        if(!Auth::guard('seeker')->check()){

            $notification = swal_alert_message_error("Please Login to continue");
            return redirect('seeker/login')->with($notification);
        }else{

            $visitor = \Tracker::currentSession();
            if($visitor->user_id == null){
                $visitor->user_id = Auth::guard('seeker')->user()->id;
                $visitor->is_seeker = 1;
                $visitor->save();
            }

            if (Auth::guard('seeker')->user()->reg_step == 2) {
                Session::put('register_step', Auth::guard('seeker')->user()->id);
                Session::save();

                $notification = swal_alert_message_error("OOps","Please Complete Registration Form to continue");
                return redirect('/seeker/register-step')->with($notification);
            }

        }

//        dd($request->request);

        return $next($request);
    }
}
