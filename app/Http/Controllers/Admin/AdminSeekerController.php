<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seeker;
use App\TrackSeekerTemplates;
use Carbon\Carbon;

class AdminSeekerController extends Controller
{
    public function index() {

        if(request('dates')){
            $tdates = explode('-', request('dates'));
            if(count($tdates) > 1){

                $weekStartDate = Carbon::parse($tdates[0]);
                $weekEndDate = Carbon::parse($tdates[1]);

                $seeker = Seeker::CountrySigned()->whereBetween('created_at', [$weekStartDate, $weekEndDate])->latest()->paginate(50);

            }
        }else{
            $seeker = Seeker::CountrySigned()->latest()->paginate(50);
        }


        return view('admin.seeker.index', compact('seeker'));
    }

    public function detailSeekers($id) {

        $seekers = Seeker::find($id);

        return view('admin.seeker.detail-seekers', compact('seekers'));
    }


    public function blockSeekers($id) {

        $response = array();
        $edit = Seeker::find($id);

        if ($edit->email_verified_at == null){

//            $edit->is_blocked = 0;
            $edit->email_verified_at = date("Y-m-d");
            $status = 'active';
        }else{
            $edit->email_verified_at = null;
//            $edit->is_blocked = 1;
            $status = 'block';
        }


        $result = $edit->save();
        if ($result) {
            $response['status'] = $status;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);
    }



    public function cvs() {

        $trackcv = TrackSeekerTemplates::all();

        return view('admin.cvs.index', compact('trackcv'));
    }





}
