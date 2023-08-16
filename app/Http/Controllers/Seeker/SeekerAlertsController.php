<?php

namespace App\Http\Controllers\Seeker;

use App\JobAlert;
use App\NotificationLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SeekerAlertsController extends Controller
{
    public function __construct()
    {
        $this->middleware('seeker');

    }

    public function index(){


            $alerts = JobAlert::where('email', Auth::guard('seeker')->user()->email)->orderBy('id', 'desc')->get();
            return view('frontend.seeker.alerts.index', compact('alerts'));
    }


    public function delete($id){

        $job_alert = JobAlert::where('random_id', $id)->first();
        if($job_alert){
            $job_alert->delete();
        }

        NotificationLogs::create([
            "notifier_id" => seeker_logged('id'),
            "notifier_type" => 'seeker',
            "message" => 'You have deleted your alert successfully',
            "url" => "#",
        ]);

        return redirect()->back()->with(swal_alert_message("Congratulations!", "You have deleted your alert successfully", "okay", 'success'));

    }


}
