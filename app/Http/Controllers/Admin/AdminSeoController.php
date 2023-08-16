<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\City;
use App\Industry;
use App\Seo;
use App\Skills;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSeoController extends Controller
{
    public function index(Request $request) {

        $seo = Seo::all();

        return view('admin.seo.index', compact('seo'));
    }

    public function addSeo(Request $request) {

        $industries = Industry::select("name","industry_slug", "total_jobs")->get();
        $locations = City::select("name","city_slug",  "total_jobs")->get();

        return view('admin.seo.add', compact('industries', 'locations'));
    }

    public function seo(Request $request) {


        if ($request->input('page_title') != '') {

            $page_key = $request->page_key;

            $seo = Seo::where('page_key', $page_key)->first();


            if ($seo == null) {

                $seo = new Seo();
                $seo->page_title = $request->page_title;
                $seo->page_key = $request->page_key;
                $seo->meta_key = $request->meta_key;
                $seo->meta_title = $request->meta_title;
                $seo->meta_description = $request->meta_description;

                $seo->save();

                return redirect('admin/seo')->with('message', 'Updated Successfully');

            } else {
                $seo->page_title = $request->page_title;
                $seo->page_key = $request->page_key;
                $seo->meta_key = $request->meta_key;
                $seo->meta_title = $request->meta_title;
                $seo->meta_description = $request->meta_description;

                $seo->save();

                return redirect('admin/seo')->with('message', 'Updated Successfully');
            }
        }

    }

    public function edit(Request $request) {

        $edit = Seo::find($request->id);

        $industries = Industry::select("name","industry_slug", "total_jobs")->get();
        $locations = City::select("name","city_slug",  "total_jobs")->get();

        return view('admin.seo.edit', compact('edit', 'industries', 'locations'));

    }

    public function update(Request $request) {


        $seo = Seo::find($request->id);
        $seo->page_title = $request->page_title;
        $seo->page_key = $request->page_key;
        $seo->meta_key = $request->meta_key;
        $seo->meta_title = $request->meta_title;
        $seo->meta_description = $request->meta_description;

        $seo->save();

        return redirect('admin/seo')->with('message', 'Updated Successfully');
    }


    public function deleteSeo($id) {

        $response = array();
        $edit = Seo::find($id)->delete();

        if ($edit) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);
    }


}
