<?php

namespace App\Http\Controllers\Api\Mobile\Seeker\Dashboard;

use App\Applicant;
use App\Job;
use App\Recruiter;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeekerDashboardController extends Controller
{

    use ApiResponse;

    public function appliedJobs(Request $request){

        $recdb = (new Recruiter())->getConnection()->getDatabaseName();
        $jobdb = (new Job())->getConnection()->getDatabaseName();

        $seeker = $request->seekerIs;
        $applied_jobs = Applicant::where('seeker_id', $seeker->id)
            ->leftJoin($jobdb.'.jobs',$jobdb.'.applicants.job_id',$jobdb.'.jobs.id')
            ->leftJoin($recdb.'.recruiters',$jobdb.'.jobs.recruiter_id',$recdb.'.recruiters.id')
            ->leftJoin($jobdb.'.cities',$jobdb.'.jobs.city',$jobdb.'.cities.id')
            ->select($jobdb.'.jobs.title',$jobdb.'.jobs.id',$jobdb.'.jobs.slug',$recdb.'.recruiters.company_name',$recdb.'.recruiters.company_logo',$jobdb.'.cities.name',$jobdb.'.applicants.created_at',$jobdb.'.applicants.viewed_at',$jobdb.'.applicants.short_listed')
            ->get();

        $data['applied'] = $applied_jobs;
        return $this->success('Applied Jobs', $data);

    }


}
