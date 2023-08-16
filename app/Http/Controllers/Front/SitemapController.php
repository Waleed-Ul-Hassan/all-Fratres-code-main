<?php

namespace App\Http\Controllers\Front;

use App\City;
use App\Industry;
use App\Job;
use App\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{

//    public function index(){
//
//        $date_time = Carbon::parse(date("Y-m-d H:i"))->tz('UTC')->toAtomString();
//
//
//        try{
//            $domain = getDomainRoot();
//             $domain = str_replace("/","", $domain);
//
//        $jobs = Job::where("job_status", 'active')->limit(1000)->get();
////        dd($jobs->pluck('created_at')->toArray());
//        $locations = City::all();
//        $industries = Industry::all();
//
//        $blogs = Blog::active()->orderByRaw('Rand()')->where('country', $domain)->get();
//        // dd($domain);
//
//        return response()->view('frontend.sitemap.index', [
//            'jobs' => $jobs,
//            'locations' => $locations,
//            'industries' => $industries,
//            'blogs' => $blogs,
//            'date_time' => $date_time,
//        ])->header('Content-Type', 'text/xml');
//
//        }catch (\Exception $e){
//            dd( $e->getMessage() . '  on line ' .$e->getLine() );
//        }
//
//    }

    public function index(){

        $date_time = Carbon::parse(date("Y-m-d H:i"))->tz('UTC')->toAtomString();


        try{
            $domain = getDomainRoot();
            $domain = str_replace("/","", $domain);

            $jobs = Job::where("job_status", 'active')->limit(1000)->get();
//        dd($jobs->pluck('created_at')->toArray());
            $locations = City::all();
            $industries = Industry::all();

            $blogs = Blog::active()->orderByRaw('Rand()')->where('country', $domain)->get();
            // dd($domain);

            return view('frontend.sitemap.index', [
                'jobs' => $jobs,
                'locations' => $locations,
                'industries' => $industries,
                'blogs' => $blogs,
                'date_time' => $date_time,
            ]);

        }catch (\Exception $e){
            dd( $e->getMessage() . '  on line ' .$e->getLine() );
        }

    }

    public function sitemap(){

        $domain = getDomainRoot();
        $domain = str_replace("/","", $domain);

        $locations = City::all();
        $industries = Industry::all();

        $blogs = Blog::active()->orderByRaw('Rand()')->where('country', $domain)->get();

        return response()->view('frontend.sitemap.sitemap', compact('locations','industries','blogs'))->header('Content-Type', 'text/xml');
    }


    public function OLDindex(){

        $date_time = Carbon::parse(date("Y-m-d H:i"))->tz('UTC')->toAtomString();


        try{
            $domain = getDomainRoot();
            $domain = str_replace("/","", $domain);

            $jobs = Job::where("job_status", 'active')->limit(1000)->get();
//        dd($jobs->pluck('created_at')->toArray());
            $locations = City::all();
            $industries = Industry::all();

            $blogs = Blog::active()->orderByRaw('Rand()')->where('country', $domain)->get();
            // dd($domain);

            return response()->view('frontend.sitemap.index', [
                'jobs' => $jobs,
                'locations' => $locations,
                'industries' => $industries,
                'blogs' => $blogs,
                'date_time' => $date_time,
            ])->header('Content-Type', 'text/xml');

        }catch (\Exception $e){
            dd( $e->getMessage() . '  on line ' .$e->getLine() );
        }

    }

}
