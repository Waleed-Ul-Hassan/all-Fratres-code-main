<?php

namespace App\Http\Controllers\Front;

use App\City;
use App\CompanyReview;
use App\Job;
use App\Recruiter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{

    public function index(){

        $recdb = (new Recruiter())->getConnection()->getDatabaseName();
        $jobdb = (new Job())->getConnection()->getDatabaseName();

        $jobss = Job::groupBy("recruiter_id")->pluck("recruiter_id")->toArray();
        $jobss = array_filter($jobss);
        $jobss = '"'. implode('","', $jobss) .'"';

        $recruiters = Recruiter::whereRaw("(recruiters.is_blocked = 0) AND (recruiters.country_signed = '".getsubDomain()."' OR recruiters.id IN(".$jobss."))")->select("recruiters.company_name","recruiters.company_slug", "recruiters.company_logo","recruiters.id","cities.name as cname", "industries.name as iname")
                    ->leftjoin($jobdb.'.cities', $jobdb.'.cities.id', $recdb.'.recruiters.city')
                    ->leftjoin($jobdb.'.industries', $jobdb.'.industries.id', $recdb.'.recruiters.industry')
                      ->get();

//        dd($recruiters);
        return view('frontend.companies.index', compact('recruiters'));

    }

    public function detail($slug){


        $rating_total = 0;
        $ratings_count = 0;

        $company = Recruiter::where("company_slug", $slug)->first();
        $jobs = $company->Activejobs;
//        dd($jobs);
        $ratings = $company->ratings;
        if( $ratings->count() > 0 ){
            $ratings_sum = $ratings->sum('rating');
            $rating_total = $ratings_sum / count($ratings);
            $ratings_count = $ratings->count();
        }
//        dd($rating_total);

        if($company)
            return view('frontend.companies.detail', compact('company','rating_total','ratings_count','jobs'));
        else
            abort(404);

    }


    public function save_rating(Request $request){



        $validator = Validator::make($request->all(), [

//            'employee_type' => 'required',
//            'email' => 'required',
//            'comments' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }


        $add_review = CompanyReview::create($request->all());

        return response()->json(['success'=> 'Review posted successfully']);

    }

    public function url($url){
//        dd($url);
//        header("Location:".$url);
         header("Location:www.lincolnlawrence.com");
    }



}
