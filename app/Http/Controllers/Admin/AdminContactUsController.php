<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminContactUsController extends Controller
{
    public function index(){

        $contactus = ContactUs::all();

        return view('admin.contactus.index',compact('contactus'));
    }

    public function saveContactUs(Request $request) {

        $response = array();
        $contactus = new ContactUs();
        $contactus->name = $request->name;
        $contactus->email = $request->email;
        $contactus->phone = $request->phone;
        $contactus->message = $request->message;

        $result = $contactus->save();

        if ($result > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }





    public function deleteSkills(Request $request, $id) {

        $response = array();
        $edit = ContactUs::find($id)->delete();

        if ($edit) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }

        return \Response::json($response);

    }
}
