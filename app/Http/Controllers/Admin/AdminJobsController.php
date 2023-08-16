<?php

namespace App\Http\Controllers\Admin;

use App\Job;
use App\Recruiter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJobsController extends Controller
{
    public function index() {

        $job = Job::query();
        $job->where("is_external", 0);
        if(request('dates')){
            $tdates = explode('-', request('dates'));
            if(count($tdates) > 1){

                $weekStartDate = Carbon::parse($tdates[0]);
                $weekEndDate = Carbon::parse($tdates[1]);

                $job->whereBetween('created_at', [$weekStartDate, $weekEndDate])->latest()->get();

            }
        }


        if (isset($_GET['status'])){
            $status = $_GET['status'];

            switch ($status) {
                case 'active':
                    $jobs = $job->where('job_status', $_GET['status'])->get();
                    return view('admin.jobs.index', compact('jobs'));
                    break;
                case 'pause':
                    $jobs = $job->where('job_status', $_GET['status'])->get();
                    return view('admin.jobs.index', compact('jobs'));
                    break;
                case 'paused':
                    $jobs = $job->where('job_status', $_GET['status'])->get();
                    return view('admin.jobs.index', compact('jobs'));
                    break;
                case 'draft':
                    $jobs = $job->where('job_status', $_GET['status'])->get();
                    return view('admin.jobs.index', compact('jobs'));
                    break;

                case 'all':
                    $jobs = $job->get();
                    return view('admin.jobs.index', compact('jobs'));
                    break;

            }
        }

        $jobs = $job->latest()->paginate(40);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function deletejobs($id) {

        $response = array();
        $edit = Job::find($id);

        if ($edit->job_status == 'pending' || $edit->job_status == 'paused' || $edit->job_status == 'draft' || $edit->job_status == 'expired') {

            $edit->job_status = 'active';
            $status = 'active';
        } elseif ($edit->job_status == 'active') {
            $edit->job_status = 'pause';
            $status = 'pause';
        } elseif ($edit->job_status == 'pause') {
            $edit->job_status = 'active';
            $status = 'active';
        }


        $result = $edit->save();
        if ($result) {
            $response['status'] = $status;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);
    }

    public function rejectjobs(Request $request, $id) {

        $response = array();
        $edit = Job::find($id);

        if ($edit->job_status == 'active') {

            $edit->job_status = 'paused';
            $status = 'paused';
            $edit->job_reject_reason = $request->text;

            $result = $edit->save();


            if ($result) {
                $response['status'] = $status;
            } else {
                $response['status'] = 0;
            }

            return \Response::json($response);
        }
    }

    public function detailjobs($id) {

        $jobs = Job::find($id);

        return view('admin.jobs.details-jobs', compact('jobs'));
    }


}
