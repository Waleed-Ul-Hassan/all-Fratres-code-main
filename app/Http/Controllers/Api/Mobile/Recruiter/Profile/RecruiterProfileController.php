<?php

namespace App\Http\Controllers\Api\Mobile\Recruiter\Profile;

use App\Recruiter;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class RecruiterProfileController extends Controller
{
    use ApiResponse;
    public function update_billing(Request $request){

        $validator = Validator::make($request->all(), [
            'billing_first_name' => 'required',
            'billing_sur_name' => 'required',
            'billing_email' => 'required',
            'billing_company_name' => 'required',
            'billing_address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'province' => 'required',
            'phone_number' => 'required',
        ]);

        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $key => $error){
                $response['errors'][$key] = $error;
            }
            return $this->error("Validation failed", $response);
        }


        $billing = array("billing_details" => $request->all());
        $billing = json_encode($billing);

        $recruiter = Recruiter::find($request->recruiterIs->id);
        $recruiter->billing_details = $billing;
        $recruiter->save();

        $response['recruiter'] = Recruiter::find($request->recruiterIs->id);

        return $this->success("Billing Info is Updated", $response);


    }

    public function update(Request $request){

        $recruiter = Recruiter::find($request->recruiterIs->id);


        $path = public_path('recruiters/profile/' . getDomainRoot());
        $path_square = public_path('recruiters/profile/' . getDomainRoot().'square_');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }


        $image_path = $path. $recruiter->company_logo;
        $image_path_square = $path_square. $recruiter->company_logo;


        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);

            $filename = time() . '.' . $ext;
            $request->company_logo = $filename;

            if (File::exists($image_path)) {
                File::delete($image_path);
                File::delete($image_path_square);
            }

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
//            $image_resize->resize(600);
            $image_resize->save($path . $filename);


            $this->resize_square($image_resize, $filename);
            //resize square img

        }else{
            $filename = $recruiter->company_logo;
        }

        if($request->has('current_password')){

            $validator = Validator::make($request->all(), [
                'password' => [
                    'required',
                    'confirmed',
                    'string',
                    'min:4',             // must be at least 3 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],

            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }


            $hashedPassword = $recruiter->password;

            if (\Hash::check($request->current_password, $hashedPassword) && $recruiter->is_social_login==0) {

                if ($request->password == $request->password_confirmation) {
                    $recruiter->password = $request->password;
                }




            }else if($recruiter->is_social_login==1){

                if ($request->password == $request->password_confirmation) {
                    $recruiter->password = $request->password;
                    $recruiter->is_social_login = 0;

                }else{
                    return $this->error("Passwords do not match");
                }

            }else{
                return $this->error("Invalid Current Password");
            }
            $recruiter->save();

            return $this->success("You Have Successfully Updated Password");

        }

        $recruiter->update($request->toArray());
        $recruiter->update(["company_logo"=> $filename]);

        $data['recruiter'] = Recruiter::find($request->recruiterIs->id);

        return $this->success("Updated Your Account", $data);

    }


    public function resize_square($image_resize, $filename){


        $path_square = public_path('recruiters/profile/' . getDomainRoot().'square_');

        //resize square img
        $width  = $image_resize->width();
        $height = $image_resize->height();


        /*
        *  canvas
        */
        $dimension = 2362;

        $vertical   = (($width < $height) ? true : false);
        $horizontal = (($width > $height) ? true : false);
        $square     = (($width = $height) ? true : false);

        if ($vertical) {
            $top = $bottom = 0;
            $newHeight = ($dimension) - ($bottom + $top);
            $image_resize->resize(null, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($horizontal) {
            $right = $left = 0;
            $newWidth = ($dimension) - ($right + $left);
            $image_resize->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($square) {
            $right = $left = 0;
            $newWidth = ($dimension) - ($left + $right);
            $image_resize->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        }

        $image_resize->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');
        $image_resize->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image_resize->save($path_square . $filename);


    }


}
