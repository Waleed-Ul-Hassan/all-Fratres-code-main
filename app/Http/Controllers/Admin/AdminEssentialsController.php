<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Industry;
use App\Page;
use App\Skills;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminEssentialsController extends Controller
{
    public function skills() {

        $skills = Skills::all();

        return view('admin.essential.skills.index', compact('skills'));
    }

    public function cities_sort() {

        if( request('q') ){
            $cities = City::whereRaw("name like '%".request('q')."%' ")->select("id","name","total_jobs")->orderBy("sort_order", "asc")->paginate(60);
        }else{
            $cities = City::select("id","name","total_jobs")->orderBy("sort_order", "asc")->paginate(60);
        }

        if (request()->ajax()) {
            return view('admin.essential.city.sort-data', compact('cities'))->render();
        }

        return view('admin.essential.city.sort', compact('cities'));
    }

    public function sort_save(Request $request) {

        $records = $request->data;
        $data = array();
//        dd($records);
        foreach ($records as $record){
            City::find($record['id'])->update(["sort_order" => $record['index']]);
//            $data[] = array("id" => $record['id'], "sort" => $record['index']);
        }

//        dd($data);
    }





    public function addSkills(Request $request) {


        return view('admin.essential.skills.add');
    }

    public function saveSkills(Request $request) {

        $response = array();
        $skills = new Skills();
        $skills->name = $request->name;

        $result = $skills->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function editSkills($id){

        $edit = Skills::find($id);

        return view('admin.essential.skills.update', compact('edit'));

    }


    public function updateSkills(Request $request){

        $response = array();
        $id = $request->id;
        $skills = Skills::find($id);
        $skills->name = $request->name;

        $result = $skills->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function deleteSkills(Request $request, $id) {

        $response = array();
        $edit = Skills::find($id)->delete();

        if ($edit) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }



    public function industries() {

        $industry = Industry::all();

        return view('admin.essential.industry.index', compact('industry'));
    }

    public function addIndustries(Request $request) {


        return view('admin.essential.industry.add');
    }

    public function saveIndustries(Request $request) {

        $response = array();
        $industry = new Industry();
        $industry->name = $request->name;

        $result = $industry->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function editIndustries($id){

        $industry = Industry::find($id);

        return view('admin.essential.industry.update', compact('industry'));

    }


    public function updateIndustries(Request $request){

        $response = array();
        $id = $request->id;
        $industry = Industry::find($id);
        $industry->name = $request->name;

        $result = $industry->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function deleteIndustries(Request $request, $id) {

        $response = array();
        $industry = Industry::find($id)->delete();

        if ($industry) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }


    public function cities() {

        $cities = City::all();

        return view('admin.essential.city.index', compact('cities'));
    }

    public function addCities(Request $request) {


        return view('admin.essential.city.add');
    }

    public function saveCities(Request $request) {

        $response = array();
        $cities = new City();
        $cities->name = $request->name;
        $cities->lat = $request->lat;
        $cities->lon = $request->lon;

        $result = $cities->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function editCities($id){

        $cities = City::find($id);

        return view('admin.essential.city.update', compact('cities'));

    }


    public function updateCities(Request $request){

        $response = array();
        $id = $request->id;
        $cities = City::find($id);
        $cities->name = $request->name;
        $cities->lat = $request->lat;
        $cities->lon = $request->lon;

        $result = $cities->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function deleteCities(Request $request, $id) {

        $response = array();
        $cities = City::find($id)->delete();

        if ($cities) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function pages(Request $request) {


        $pages = Page::all();

        return view('admin.essential.pages.index', compact('pages'));
    }

    public function addPages(Request $request) {

        return view('admin.essential.pages.add');
    }

    public function savePages(Request $request) {

        $response = array();
        $pages = new Page();
        $pages->privacy = $request->privacy;
        $pages->terms = $request->terms;
        $pages->about = $request->about;

        $result = $pages->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function editPages($id){

        $pages = Page::find($id);

        return view('admin.essential.pages.update', compact('pages'));

    }

    public function updatePages(Request $request) {

        $response = array();
        $id = $request->id;
        $pages = Page::find($id);
        $pages->privacy = $request->privacy;
        $pages->terms = $request->terms;
        $pages->about = $request->about;

        $result = $pages->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);
    }
}
