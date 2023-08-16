<?php

namespace App\Http\Controllers\Admin;

use App\JobAlert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJobAlertsController extends Controller
{
    public function index(Request $request){

        if(request('dates')){
            $tdates = explode('-', request('dates'));
            if(count($tdates) > 1){

                $weekStartDate = Carbon::parse($tdates[0]);
                $weekEndDate = Carbon::parse($tdates[1]);

                $jobAlerts = JobAlert::whereBetween('created_at', [$weekStartDate, $weekEndDate])->latest()->paginate(100);

            }
        }else{
            $jobAlerts = JobAlert::latest()->paginate(40);
        }



        return view('admin.jobAlerts.index',compact('jobAlerts'));

    }
}
