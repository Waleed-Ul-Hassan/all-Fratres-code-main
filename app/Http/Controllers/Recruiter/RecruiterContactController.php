<?php

namespace App\Http\Controllers\Recruiter;

use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruiterContactController extends Controller
{


    public function index(){

        $contacts = ContactUs::where('recruiter_id', recruiter_logged('id'))->orderBy('id','desc')->get();

        return view('frontend.recruiter.contact.index', compact('contacts'));
    }


    public function contact(Request $request){

        $contact = new ContactUs();

//        dd($request);

        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->email = recruiter_logged('email');
        $contact->name = recruiter_logged('first_name');
        $contact->recruiter_id = recruiter_logged('id');
        $contact->save();

        return redirect()->back()->with(swal_alert_message('Congrats','Your messgae has been received, Our Team will review and will get back to you','Okay','success'));


    }

}
