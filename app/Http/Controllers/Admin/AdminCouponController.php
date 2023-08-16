<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCouponController extends Controller
{
    public function coupons() {

        $coupon = Coupon::all();

        return view('admin.essential.coupon.index', compact('coupon'));
    }

    public function addCoupons(Request $request) {


        return view('admin.essential.coupon.add');
    }

    public function saveCoupons(Request $request) {

        $response = array();
        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount = $request->discount;

        $result = $coupon->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function editCoupons($id){

        $edit = Coupon::find($id);

        return view('admin.essential.coupon.update', compact('edit'));

    }


    public function updateCoupons(Request $request){

        $response = array();
        $id = $request->id;
        $coupon = Coupon::find($id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount = $request->discount;

        $result = $coupon->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }

    public function deleteCoupons(Request $request, $id) {

        $response = array();
        $edit = Coupon::find($id)->delete();

        if ($edit) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }
}
