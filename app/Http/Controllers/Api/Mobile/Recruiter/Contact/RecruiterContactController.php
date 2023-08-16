<?php

namespace App\Http\Controllers\Api\Mobile\Recruiter\Contact;

use App\ContactUs;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RecruiterContactController extends Controller
{

    use ApiResponse;
    public function index(Request $request){

        $data['contacts'] = ContactUs::where('recruiter_id', $request->recruiterIs->id)->orderBy('id','desc')->get();

        return $this->success("Contacts", $data);

    }


    public function contact(Request $request){

        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $key => $error){
                $response['errors'][$key] = $error;
            }
            return $this->error("Validation failed", $response);
        }

        $contact = new ContactUs();

        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->email = $request->recruiterIs->email;
        $contact->name = $request->recruiterIs->first_name;
        $contact->recruiter_id = $request->recruiterIs->id;
        $contact->save();

        $data['contacts'] = ContactUs::where('recruiter_id', $request->recruiterIs->id)->orderBy('id','desc')->get();

        return $this->success("Your messgae has been received, Our Team will review and will get back to you", $data);


    }

}
