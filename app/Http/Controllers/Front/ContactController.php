<?php

namespace App\Http\Controllers\Front;

use App\AdminSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRequestsGeneric;
use Illuminate\Support\Facades\Request;

class ContactController extends Controller
{

    public function index(){

        return view('frontend.contact.index');
    }

    public function contact_request(ValidateRequestsGeneric $request){

        $settings = AdminSetting::first();

        $data = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'status' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);


        $subject = 'Fratres Contact Request - Fratres '.$settings->country_name;
        $mesg = '';

        $mesg .= '<p>You have a new request from fratres '.$settings->country_name.' domain ('.url('/').')</p>';
        $mesg .= '<p>Name : '.$request->name.'</p>';
        $mesg .= '<p>Email : '.$request->email.'</p>';
        $mesg .= '<p>Status : '.$request->status.'</p>';
        $mesg .= '<p>Message : '.$request->message.'</p>';

        verify_email("info@fratres.net", $subject, $mesg, "", "noreply@fratres.net");

        $notification = swal_alert_message("Thanks", "We have received your request and will be get back to you shortly", "Okay", 'success');
        return redirect('contact')->with($notification);

    }



}


?>