<?php

namespace App\Http\Controllers\Api\Mobile\Recruiter\Dashboard;

use App\Applicant;
use App\Job;
use App\Order;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruiterDashboardController extends Controller
{
    use ApiResponse;
    public $recruiter = 'recruiter';

    public function index(Request $request){

//        dd($request->recruiterIs);
        $jobs = Job::with('recruiter')->where("recruiter_id", $request->recruiterIs->id)->get();

        $applicants = Applicant::whereIn('job_id', $jobs->pluck('id'))->get();
        $total_applicants = Applicant::whereIn('job_id', $jobs->pluck('id'))->count();

        $orders = Order::whereRaw(" (order_type = 'single_job' OR order_type = 'single_job_credit' OR order_type = 'cvs_purchased' ) ")->where("recruiter_id", $request->recruiterIs->id)->orderBy('id','DESC')->get();

        $total_amount = Order::whereRaw(" (order_type = 'single_job' OR order_type = 'cvs_purchased' ) ")->where("recruiter_id", $request->recruiterIs->id)->sum('total_amount');

        $data['applicants'] = $applicants;
        $data['jobs'] = $jobs;
        $data['total_applicants'] = $total_applicants;
        $data['orders'] = $orders;
        $data['total_amount'] = $total_amount;

        return $this->success("Data Found", $data);

    }

}
