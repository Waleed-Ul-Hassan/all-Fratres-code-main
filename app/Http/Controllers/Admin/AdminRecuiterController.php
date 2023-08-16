<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Recruiter;
use App\Seeker;
use Carbon\Carbon;

class AdminRecuiterController extends Controller
{
    public function index() {

        if(request('dates')){
            $tdates = explode('-', request('dates'));
            if(count($tdates) > 1){

                $weekStartDate = Carbon::parse($tdates[0]);
                $weekEndDate = Carbon::parse($tdates[1]);

                $recruiter = Recruiter::CountrySigned()->whereBetween('created_at', [$weekStartDate, $weekEndDate])->latest()->paginate(50);

            }
        }else{
            $recruiter = Recruiter::CountrySigned()->latest()->paginate(50);
        }



        return view('admin.recruiter.index', compact('recruiter'));
    }

    public function detailRecuiter($id) {
        $recruiter = Recruiter::find($id);
        $orders = $recruiter->orders();
        return view('admin.recruiter.detail-recruiters', compact('recruiter', 'orders'));
    }

    public function blockSeekers($id) {

        $response = array();
        $edit = Recruiter::find($id);

        if ($edit->email_verified_at == null) {

            $edit->email_verified_at = date("Y-m-d");
            $edit->is_blocked = 0;
            $status = 'active';
        } else {
            $edit->email_verified_at = null;
            $edit->is_blocked = 1;
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

    public function orders() {

//        $recruiters = Recruiter::find();
        if(request('dates')){
            $tdates = explode('-', request('dates'));
            if(count($tdates) > 1){

                $weekStartDate = Carbon::parse($tdates[0]);
                $weekEndDate = Carbon::parse($tdates[1]);

                $orders = Order::whereBetween('created_at', [$weekStartDate, $weekEndDate])->latest()->paginate(100);

            }
        }else{
            $orders = Order::latest()->paginate(20);
        }


        return view('admin.orders.index', compact('orders'));
    }




}
