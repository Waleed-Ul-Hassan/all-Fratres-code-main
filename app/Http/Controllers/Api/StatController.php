<?php

namespace App\Http\Controllers\Api;

use App\AdminSetting;
use App\Blog;
use App\Http\Controllers\Controller;
use App\Job;
use App\JobAlert;
use App\Order;
use App\Recruiter;
use App\Seeker;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class StatController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        abort(419);
        dd( $request->key );
    }

    public function getStats(Request $request)
    {

        if( $request->key == '0900' ){


            $settings = AdminSetting::first();
            $seekers = Seeker::where("country_signed", $settings->country_code)->count();
            $cvs_uploaded = Seeker::whereRaw("(cv_resume IS NOT NULL) AND (country_signed = '".$settings->country_code."')")->count();
            $recruiters = Recruiter::where("country_signed", $settings->country_code)->count();
            $jobs = Job::IsActive()->count();
            $orders = Order::Completed()->count();
            $jobAlerts = JobAlert::count();
            $blogs = Blog::where("country", $settings->country_code)->count();

            $data['website_title'] = $settings->country_name;
            $data['domain'] = url('/');
            $data['seekers'] = $seekers;
            $data['recruiters'] = $recruiters;
            $data['jobs'] = $jobs;
            $data['orders'] = $orders;
            $data['alerts'] = $jobAlerts;
            $data['blogs'] = $blogs;
            $data['cvs_uploaded'] = $cvs_uploaded;

//            return view('admin.ajax.table', $data);
            return response()->json($data);


        }

    }


    public function app_colors(){
        $first = AdminSetting::first();

        $data['settings'] = json_decode($first->app_settings);

        return $this->success("", $data);

    }

}

?>